<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanSarpras extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan_sarpras';
    protected $guarded = [];

    public function jawaban()
    {
        return $this->hasMany(JawabanSarpras::class);
    }

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerSarpras::class);
    }
}
