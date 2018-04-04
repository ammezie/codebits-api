<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function bit()
    {
        return $this->belongsTo(Bit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
