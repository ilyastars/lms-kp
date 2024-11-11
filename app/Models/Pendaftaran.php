<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    /** @use HasFactory<\Database\Factories\PendaftaranFactory> */
    use HasFactory;
    protected $guarded = [];

    // /**
    //  * Get the user that owns the Daftar
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class)->withDefault();
    // }

    /**
     * Get the jadwal that owns the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(Jadwal::class)->withDefault();
    }

}
