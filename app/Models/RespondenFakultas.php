<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenFakultas extends Model
{
    use HasFactory;

    protected $table = 'responden_fakultas';
    protected $guarded = [];

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerFakultas::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailRespondenFakultas::class);
    }
}
