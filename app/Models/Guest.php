<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = ['wedding_id', 'name', 'phone', 'status'];

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }
}
