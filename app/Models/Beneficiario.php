<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Beneficiario extends Model
{
    use HasFactory;
    protected $table = 'beneficiarios';


    /**
     * Obtiene el id del registro social del beneficiario
     * 
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function registrosocial(): HasOne
    {
        return $this->hasOne(Registrosocial::class, 'registrosociales_id', 'id');
    }

    /**
     * las solicitudes hechas por el beneficiario a traves de un pivote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudes(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'solicitudes', 'materiales_id', 'beneficiario_id')
                    ->as('solicitud')
                    ->withPivot('cantidad', 'medida', 'entregado')
                    ->withTimestamps();

    }
    





    
}
