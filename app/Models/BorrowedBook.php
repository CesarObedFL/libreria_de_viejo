<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
	protected $table = 'borrowed_books';

    protected $fillable = [ 'borrow_id', 'book_id', /*'featureID',*/ 'amount', 'status' ];

    public $timestamps = false;

    protected function borrows()
    {
    	return $this->belongsTo(Borrow::class, 'borrow_id', 'id');
    }

    protected function book()
    {
    	return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
