<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bit extends Model
{
    protected $casts = [
        'created_at' => 'string',
        'updated_at' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Bit::class, 'bit_id');
    }

    // public function bit()
    // {
    //     return $this->belongsTo(Bit::class, 'bit_id');
    // }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }
}
