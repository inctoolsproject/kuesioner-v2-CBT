<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenVisiMisi extends Model
{
    use HasFactory;
    protected $table = 'responden_visi_misi';
    protected $guarded = [];

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerVisiMisi::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailRespondenVisiMisi::class);
    }
}
