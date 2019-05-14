<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SwapBook extends Model
{
	protected $table = 'swaped_books';

    protected $fillable = [
        'swapID', 
        'bookID', 
        //'featureID',
        'type',     // [Enbtrante | Saliente]
        'status'    // [Sin Registro | Registrado]
    ];

    public $timestamps = false;

    protected function swap()
    {
    	return $this->belongsTo(Loan::class,'swapID');
    }

    protected function book()
    {
    	return $this->belongsTo(Book::class,'bookID');
    }
}
