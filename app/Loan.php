<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Loan extends Model
{
    protected $table = 'loans';
    public $timestamps = false;

    protected $fillable = ['amount', 'outDate', 'inDate', 'clientID','userID','status'];

    public function client()
    {
    	return $this->belongsTo(Client::class, 'clientID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function getOutDate()
    {
    	$DATE = Carbon::parse($this->outDate);
    	return $DATE->format('d/m/Y');
    }

    public function getInDate()
    {
    	$DATE = Carbon::parse($this->inDate);
    	return $DATE->format('d/m/Y');
    }

    public function getOwed()
    {
    	$PAYPERDAY = 5;
    	if(Carbon::now()->greaterThan(Carbon::parse($this->inDate))) {
    		return Carbon::now()->diffInDays(Carbon::parse($this->inDate)) * $PAYPERDAY;
    	} else
    		return "0";
    }
}
