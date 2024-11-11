<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarUser extends Model
{
    /** @use HasFactory<\Database\Factories\DaftarUserFactory> */
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the skema that owns the DaftarUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function skema(): BelongsTo
    {
        return $this->belongsTo(Skema::class);
    }
}
