<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRespondenLP2M extends Model
{
    use HasFactory;

    protected $table = 'detail_respon_lp2m';
    protected $guarded = [];

    public function responden()
    {
        return $this->belongsTo(RespondenLP2M::class);
    }
}
