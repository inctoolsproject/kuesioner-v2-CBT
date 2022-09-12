<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespondenLP2M extends Model
{
    use HasFactory;

    protected $table = 'responden_lp2m';
    protected $guarded = [];

    public function kuesioner()
    {
        return $this->belongsTo(KuesionerLP2M::class, 'kuesioner_lp2m_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailRespondenLP2M::class, 'responden_lp2m_id');
    }
}
