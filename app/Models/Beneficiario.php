<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * Get the registrosical associated with the Beneficiario
     *
     * @return \IlluminaBeneficiarioatabase\Elregistrosociales_idtions\HasOne
     */

    /*
    public function registrosocial(): HasOne
    {
        return $this->hasOne(Beneficiario::class, 'registrosociales_id', 'id');
    }*/

    /**
     * las solicitudes hechas por el beneficiario a traves de un pivote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudes(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'solicitudes',  'beneficiario_id', 'materiales_id')
                    ->as('solicitudes')
                    ->withPivot('cantidad', 'medida', 'entregado','id', 'domicilio' )
                    ->withTimestamps();

    }
    /**
     * las solicitudes hechas por el beneficiario a traves de un pivote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function entregados(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'entregados',  'beneficiario_id', 'materiales_id')
                    ->as('entregados')
                    ->withPivot('cantidad', 'medida', 'domicilio')
                    ->withTimestamps();

    }

    /**
     * Get all of the comments for the Beneficiario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devoluciones(): HasMany
    {
        return $this->hasMany(Reembolso::class, 'beneficiarios_id', 'id');
    }

}
