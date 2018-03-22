<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Snippet::class, 'snippet_id');
    }

    public function snippet()
    {
        return $this->belongsTo(Snippet::class, 'snippet_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
