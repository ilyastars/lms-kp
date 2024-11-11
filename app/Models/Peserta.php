<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peserta extends Model
{
    /** @use HasFactory<\Database\Factories\PesertaFactory> */
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the pendaftaran associated with the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pendaftaran(): HasOne
    {
        return $this->hasOne(Pendaftaran::class);
    }

    /**
     * Get the jadwal associated with the Peserta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jadwal(): HasOne
    {
        return $this->hasOne(Jadwal::class);
    }

}
