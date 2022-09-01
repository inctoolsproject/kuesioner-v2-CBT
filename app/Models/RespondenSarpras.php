<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenSarpras extends Model
{
    use HasFactory;
    protected $table = 'responden_sarpras';
    protected $guarded = [];

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerSarpras::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailRespondenSarpras::class);
    }
}
