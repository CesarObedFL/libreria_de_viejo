<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
	protected $table = 'borrowed_books';

    protected $fillable = ['borrowID','bookID', /*'featureID',*/ 'amount','status'];

    public $timestamps = false;

    protected function borrows()
    {
    	return $this->belongsTo(Borrow::class,'borrowID');
    }

    protected function book()
    {
    	return $this->belongsTo(Book::class,'bookID');
    }
}
