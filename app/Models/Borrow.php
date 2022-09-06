<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Borrow extends Model
{
    protected $table = 'borrows';
    
    public $timestamps = false;

    protected $fillable = [ 'amount_book', 'out_date', 'in_date', 'client_id', 'user_id', 'amount', 'status' ];

    public function client()
    {
    	return $this->belongsTo(Client::class,'client_id', 'id')->withDefault([
                'name' => 'borrado'
            ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id')->withDefault([
                'name' => 'borrado'
            ]);
    }

    public function borrowed_books()
    {
        return $this->hasMany(BorrowedBook::class, 'borrow_id', 'id');
    }

    public function getOutDate()
    {
    	return Carbon::parse($this->out_date)->format('d/m/Y');
    }

    public function getInDate()
    {
    	return Carbon::parse($this->in_date)->format('d/m/Y');
    }

    public function getDays()
    {
        if($this->status == 'Activo')
            return Carbon::now()->diffInDays(Carbon::parse($this->in_date));
        else
            return 0;
    }

    public function getOwed()
    {
        if($this->status == 'Activo') {
        	$pay_per_day = 5;
        	if(Carbon::now()->greaterThan(Carbon::parse($this->in_date)))
        		return Carbon::now()->diffInDays(Carbon::parse($this->in_date)) * $pay_per_day.'.00';
        	else
        		return '0.00';
        } else 
            return '-------';
    }

    public function getCondition()
    {
        if($this->status == 'Activo')
            return (Carbon::now()->greaterThan(Carbon::parse($this->in_date))) ? 'Vencido' : 'Activo';
        else
            return 'Entregado';
        
    }

    public function getStatus() 
    {
        return ($this->status == 'Entregado') ? 1 : 0;
    }
}
