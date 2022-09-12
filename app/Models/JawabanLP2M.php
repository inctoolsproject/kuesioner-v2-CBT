<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanLP2M extends Model
{
    use HasFactory;

    protected $table = 'jawaban_lp2m';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanLP2M::class, 'pertanyaan_lp2m_id');
    }

    public function responden()
    {
        return $this->belongsTo(RespondenLP2M::class, 'responden_lp2m_id');
    }
}
