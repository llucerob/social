<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Material extends Model
{
    use HasFactory;
    protected $table = 'materiales';

    /**
     * obtiene categoria a la que pertenece el material
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    /**
     * obtiene las solicitudes de material
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitud(): BelongsToMany
    {
        return $this->belongsToMany(Beneficiario::class, 'solicitudes', 'materiales_id', 'beneficiarios_id')
                    ->as('solicitud')
                    ->withPivot('cantidad', 'medida', 'entregado')
                    ->withTimestamps();;
    }

    
    
}
