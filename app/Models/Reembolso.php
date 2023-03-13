<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reembolso extends Model
{
    use HasFactory;
    protected $table = 'reembolsos';
    

    /**
     * relaciona un reembolso al usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function beneficiario(): HasOne
    {
        return $this->hasOne(Beneficiario::class, 'beneficiarios_id', 'id');
    }
}
