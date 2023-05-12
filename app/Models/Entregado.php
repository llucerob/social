<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entregado extends Model
{
    use HasFactory;
    protected $table = 'entregados';



    /**
     * Get the user that owns the Entregado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(Beneficiario::class, 'beneficiario_id', 'id');
    }

    /**
     * Get the material that owns the Entregado
     *
     * @return \Illuminate\Materialbase\Eloqumateriales_idns\BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class,  'materiales_id', 'id');
    }

}
