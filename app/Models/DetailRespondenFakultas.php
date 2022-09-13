<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRespondenFakultas extends Model
{
    use HasFactory;

    protected $table = 'detail_respon_fakultas';
    protected $guarded = [];

    public function responden()
    {
        return $this->belongsTo(RespondenFakultas::class);
    }
}
