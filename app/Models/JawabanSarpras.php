<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSarpras extends Model
{
    use HasFactory;

    protected $table = 'jawaban_sarpras';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanSarpras::class);
    }

    public function responden()
    {
        return $this->belongsTo(RespondenSarpras::class);
    }
}
