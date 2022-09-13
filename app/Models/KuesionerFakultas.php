<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerFakultas extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_fakultas';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanFakultas::class);
    }

    public function responden()
    {
        return $this->hasMany(RespondenFakultas::class);
    }

    public function scopeForMahasiswa($query)
    {
        return $query->where('tipe', 'mahasiswa');
    }
    public function scopeForDosen($query)
    {
        return $query->where('tipe', 'dosen');
    }
}
