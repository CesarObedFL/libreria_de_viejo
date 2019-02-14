<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role',
    ];

    /*protected $casts = [
        'created_at' => 'datetime:d-m-Y'
    ];*/

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUserRoleAttribute()
    {
        return $this->name . ' : ' . $this->role;
    }
}
