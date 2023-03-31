<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registrosocial extends Model
{
    use HasFactory;
    protected $table = 'registrosociales';

    /**
     * Get the user associated with the Registrosocial
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario(): HasOne
    {
        return $this->hasOne(Beneficiario::class, 'registrosociales_id', 'id');
    }
}
