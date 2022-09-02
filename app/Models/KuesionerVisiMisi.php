<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerVisiMisi extends Model
{
    use HasFactory;
    protected $table = 'kuesioner_visi_misi';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanVisiMisi::class);
    }

    public function responden()
    {
        return $this->hasMany(RespondenVisiMisi::class);
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
