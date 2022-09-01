<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerAkademik extends Model
{
    use HasFactory;
    protected $table = 'kuesioner_akademik';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanAkademik::class);
    }

    public function responden()
    {
        return $this->hasMany(RespondenAkademik::class);
    }

    public function scopeForMahasiswa($query)
    {
        return $query->where('tipe', 'mahasiswa');
    }
}
