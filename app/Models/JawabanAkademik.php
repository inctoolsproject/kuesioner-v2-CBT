<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanAkademik extends Model
{
    use HasFactory;
    protected $table = 'jawaban_akademik';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanAkademik::class);
    }

    public function responden()
    {
        return $this->belongsTo(RespondenAkademik::class);
    }
}
