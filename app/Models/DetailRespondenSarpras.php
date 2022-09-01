<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRespondenSarpras extends Model
{
    use HasFactory;
    protected $table = 'detail_respon_sarpras';
    protected $guarded = [];

    public function responden()
    {
        return $this->belongsTo(RespondenSarpras::class);
    }
}
