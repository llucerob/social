<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beneficiario extends Model
{
    use HasFactory;
    protected $table = 'beneficiarios';


    /**
     * Get the registrosocial that owns the Beneficiario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registrosocial(): BelongsTo
    {
        return $this->belongsTo(Registrosocial::class, 'registrosociales_id', 'id');
    }

    /**
     * las solicitudes hechas por el beneficiario a traves de un pivote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudes(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'solicitudes',  'beneficiario_id', 'materiales_id')
                    ->as('solicitudes')
                    ->withPivot('cantidad', 'medida', 'entregado')
                    ->withTimestamps();

    }
    





    
}
