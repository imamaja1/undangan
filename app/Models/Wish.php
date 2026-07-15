<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    protected $fillable = [
        'wedding_id', 'name', 'initial', 'message',
    ];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
