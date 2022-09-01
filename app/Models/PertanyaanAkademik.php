<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanAkademik extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan_akademik';
    protected $guarded = [];

    public function jawaban()
    {
        return $this->hasMany(JawabanAkademik::class);
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerAkademik::class);
    }
}
