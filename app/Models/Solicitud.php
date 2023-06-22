<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';



    /**
     * Get the beneficiario that owns the Solicitud
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }

    
}
