<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenAkademik extends Model
{
    use HasFactory;
    protected $table = 'responden_akademik';
    protected $guarded = [];

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerAkademik::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailResponden::class);
    }
}
