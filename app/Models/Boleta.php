<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Boleta extends Model
{
    use HasFactory;
    protected $table = 'boletas';

    /**
     * obtiene el reembolso a la respectiva boleta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reembolso(): HasOne
    {
        return $this->hasOne(Reembolso::class, 'reembolsos_id', 'id');
    }

}
