<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanVisiMisi extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan_visi_misi';
    protected $guarded = [];

    public function jawaban()
    {
        return $this->hasMany(JawabanVisiMisi::class);
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerVisiMisi::class);
    }
}
