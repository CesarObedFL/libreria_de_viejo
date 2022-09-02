<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapBook extends Model
{
	protected $table = 'swaped_books';

    protected $fillable = [
        'swapID', 
        'bookID', // ISBN
        //'featureID',
        'type',     // [Entrante | Saliente]
        'status'    // [Sin Registro | Registrado]
    ];

    public $timestamps = false;

    protected function swap()
    {
    	return $this->belongsTo(Loan::class,'swapID');
    }

    protected function book()
    {
    	//return $this->belongsTo(Book::class,'bookID');
        return $this->belongsTo(Book::class,'bookID','ISBN');
    }
}
