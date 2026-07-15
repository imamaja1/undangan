<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'wedding_id', 'sort_order', 'date_label', 'title', 'description', 'image', 'animation',
    ];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
