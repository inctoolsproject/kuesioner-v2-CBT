<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanFakultas extends Model
{
    use HasFactory;

    protected $table = 'jawaban_fakultas';
    protected $guarded = [];

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanFakultas::class);
    }

    public function responden()
    {
        return $this->belongsTo(RespondenFakultas::class);
    }
}
