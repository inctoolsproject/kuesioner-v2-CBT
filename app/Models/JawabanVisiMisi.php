<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanVisiMisi extends Model
{
    use HasFactory;
    protected $table = 'jawaban_visi_misi';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanVisiMisi::class);
    }

    public function responden()
    {
        return $this->belongsTo(RespondenVisiMisi::class);
    }
}
