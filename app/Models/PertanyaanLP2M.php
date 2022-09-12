<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanLP2M extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan_lp2m';
    protected $guarded = [];

    public function jawaban()
    {
        return $this->hasMany(JawabanLP2M::class, 'pertanyaan_lp2m_id');
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerLP2M::class, 'kuesioner_lp2m_id');
    }
}
