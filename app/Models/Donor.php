<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
	protected $table = 'donors';
	
    protected $fillable = [ 'institution', 'contact', 'email', 'phone', 'address', 'commercial_business' ];

    public $timestamps = false;

    protected function donations()
    {
    	return $this->hasMany(Donation::class, 'donor_id', 'id');
    } 

    public function getDonor() 
    {
    	return $this->institution.' : '.$this->contact;
    }
}
