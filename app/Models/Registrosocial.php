<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Registrosocial extends Model
{
    use HasFactory;
    protected $table = 'registrosociales';

    /**
     * Get the user associated with the Registrosocial
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiarios(): HasMany
    {
        return $this->hasMAny(Beneficiario::class, 'registrosociales_id', 'id');
    }
}
