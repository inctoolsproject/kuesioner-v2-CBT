<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanFakultas extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan_fakultas';
    protected $guarded = [];

    public function jawaban()
    {
        return $this->hasMany(JawabanFakultas::class);
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerFakultas::class);
    }
}
