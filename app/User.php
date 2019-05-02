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

    public function isAdmin()
    {
        return ($this->role == "Administrador") ? true : false;
    }

    public function getUser()
    {
        return $this->name . ' : ' . $this->email;
    }

    public function donations()
    {
        return $this->hasMany('App\Donation','userID','ID');
    }

    public function loans()
    {
        return $this->hasMany('App\Loan','userID','ID');
    }
}
