<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class CuentaBancaria extends Model
{
    use HasFactory;
    protected $table = 'cuentasbancarias';
    
    /**
     * Get the user that owns the CuentaBancaria
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(Beneficiario::class, 'beneficiario_id', 'id');
    }
    
}
