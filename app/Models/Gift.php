<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'wedding_id', 'qris_enabled', 'qris_image',
    ];

    protected function casts(): array
    {
        return [
            'qris_enabled' => 'boolean',
        ];
    }

    public function wedding()
    {
        return $this->belongsTo(Wedding::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
}
