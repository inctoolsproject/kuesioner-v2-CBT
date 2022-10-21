<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRespondenVisiMisi extends Model
{
    use HasFactory;
    protected $table = 'detail_respon_visi_misi';
    protected $guarded = [];

    public function responden()
    {
        return $this->belongsTo(RespondenVisiMisi::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(PertanyaanVisiMisi::class, 'pertanyaan_visi_misi_id', 'id');
    }

    public function jawaban()
    {
        return $this->belongsTo(JawabanVisiMisi::class);
    }
}
