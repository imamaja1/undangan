<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'wedding_id', 'type', 'title', 'icon', 'date', 'time', 'venue', 'address', 'calendar_link',
    ];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
