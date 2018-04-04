<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $timestamps = false;

    public function bit()
    {
        return $this->belongsTo(Bit::class);
    }
}
