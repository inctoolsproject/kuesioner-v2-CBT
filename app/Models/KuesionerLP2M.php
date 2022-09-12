<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerLP2M extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_lp2m';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanLP2M::class, 'kuesioner_lp2m_id');
    }

    public function responden()
    {
        return $this->hasMany(RespondenLP2M::class, 'kuesioner_lp2m_id');
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
