<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SolicitudMunicipal extends Model
{
    use HasFactory;

    protected $table = 'solicitudesmunicipales';



    /**
     * The roles that belong to the SolicitudMunicipal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudmunicipal(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'materialesmunicipales', 'solicitudesmunicipales_id', 'material_id')
                                    ->as('solicitudmunicipal')
                                    ->withPivot('cantidad', 'unidad')
                                    ->withTimestamps();
    }


}
