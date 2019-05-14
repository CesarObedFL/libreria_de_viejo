<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = ['name','email','phone','interests','type'];

    public $timestamps = false;

    public function borrows()
    {
    	return $this->hasMany('App\Borrow','clientID','id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice','clientID','id');
    }

    public function getInfo()
    {
    	return $this->name.' : '.$this->email;
    }

}
