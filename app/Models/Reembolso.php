<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reembolso extends Model
{
    use HasFactory;
    protected $table = 'reembolsos';


    /**
     * Get the user that owns the Reembolso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(Beneficiario::class, 'beneficiarios_id', 'id');
    }


    /**
     * Get all of the comments for the Reembolso
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boletas(): HasMany
    {
        return $this->hasMany(Boleta::class, 'reembolsos_id', 'id');
    }



}
