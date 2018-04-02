<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'created_at' => 'string',
        'updated_at' => 'string',
    ];

    public function bits()
    {
        return $this->hasMany(Bit::class);
    }

    // public function replies()
    // {
    //     return $this->hasMany(Bit::class, 'bit_id');
    // }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }
}
