<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapBook extends Model
{
	protected $table = 'swaped_books';

    protected $fillable = [
        'swap_id', 
        'book_id',
        //'featureID',
        'type',     // [Entrante | Saliente]
        'status'    // [Sin Registro | Registrado]
    ];

    public $timestamps = false;

    public function swap()
    {
    	return $this->belongsTo(Swap::class, 'swap_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
