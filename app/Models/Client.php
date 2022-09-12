<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = [ 'name', 'email', 'phone', 'interests', 'type' ];

    public $timestamps = false;

    public function borrows()
    {
    	return $this->hasMany(Borrow::class, 'client_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id', 'id');
    }

    public function getInfo()
    {
    	return $this->name.' : '.$this->email;
    }

}
