<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerSarpras extends Model
{
    use HasFactory;

    protected $table = 'kuesioner_sarpras';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->hasMany(PertanyaanSarpras::class);
    }

    public function responden()
    {
        return $this->hasMany(RespondenSarpras::class);
    }

    public function scopeForMahasiswa($query)
    {
        return $query->where('tipe', 'mahasiswa');
    }
}
