<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    protected $fillable = [
        'couple', 'wedding_info', 'quotes', 'wa_number', 'sections',
    ];

    protected function casts(): array
    {
        return [
            'couple' => 'array',
            'wedding_info' => 'array',
            'quotes' => 'array',
            'sections' => 'array',
        ];
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class)->orderBy('sort_order');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class)->orderBy('sort_order');
    }

    public function gift()
    {
        return $this->hasOne(Gift::class);
    }

    public function wishes()
    {
        return $this->hasMany(Wish::class)->latest();
    }
}
