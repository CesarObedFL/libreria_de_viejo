<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Borrow extends Model
{
    protected $table = 'borrows';
    public $timestamps = false;

    protected $fillable = ['amountbooks', 'outDate', 'inDate', 'clientID','userID','amount','status'];

    public function client()
    {
    	return $this->belongsTo(Client::class,'clientID')->withDefault([
                'name' => 'borrado'
            ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userID')->withDefault([
                'name' => 'borrado'
            ]);
    }

    public function borrowedbooks()
    {
        return $this->hasMany('App\BorrowedBook','borrowID','id');
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

    public function getDays()
    {
        if($this->status == 'Activo')
            return Carbon::now()->diffInDays(Carbon::parse($this->inDate));
        else
            return 0;
    }

    public function getOwed()
    {
        if($this->status == 'Activo') {
        	$PAYPERDAY = 5;
        	if(Carbon::now()->greaterThan(Carbon::parse($this->inDate)))
        		return Carbon::now()->diffInDays(Carbon::parse($this->inDate)) * $PAYPERDAY.'.00';
        	else
        		return '0.00';
        } else 
            return '-------';
    }

    public function getCondition()
    {
        if($this->status == 'Activo')
            return (Carbon::now()->greaterThan(Carbon::parse($this->inDate))) ? 'Vencido' : 'Activo';
        else
            return 'Entregado';
        
    }

    public function getStatus() 
    {
        return ($this->status == 'Entregado') ? 1 : 0;
    }
}
