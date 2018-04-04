<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bit extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }
}
