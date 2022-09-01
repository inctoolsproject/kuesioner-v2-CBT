<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRespondenAkademik extends Model
{
    use HasFactory;
    protected $table = 'detail_respon_akademik';
    protected $guarded = [];

    public function responden()
    {
        return $this->belongsTo(RespondenAkademik::class);
    }
}
