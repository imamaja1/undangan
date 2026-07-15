<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'wedding_id', 'sort_order', 'src', 'alt', 'title',
    ];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
