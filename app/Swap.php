<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Swap extends Model
{
    protected $table = 'swaps';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'userID',
        'incoming',     // cantidad de libros entrantes
        'outcoming',    // cantidad de libros salientes
        'amounttopay'
    ];

	public function swapedbooks()
    {
        return $this->hasMany('App\SwapBook','swapID','id');
    }

    public function inbooks()
    {
        return $this->hasMany('App\SwapBook','swapID','id')->where('type','Entrante');
    }

    public function outbooks()
    {
        return $this->hasMany('App\SwapBook','swapID','id')->where('type','Saliente');
    }

    public function isComplete()
    {
        if($this->inbooks->where('status','Sin Registro')->count() > 0)
            return 'Incompleto';

        return 'Completo';
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'userID');
    }

    public function getDate()
    {
    	$DATE = Carbon::parse($this->date);
    	return $DATE->format('d/m/Y');
    }
}
