<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
	protected $table = 'donors';
	
    protected $fillable = ['institution', 'contact', 'email', 'phone', 'address', 'commercialBusiness'];

    public $timestamps = false;
}
