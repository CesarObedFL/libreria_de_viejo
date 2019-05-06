<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
	protected $table = 'borrowed_books';

    protected $fillable = ['loanID','bookID', /*'featureID',*/ 'status'];

    public $timestamps = false;

    protected function loans()
    {
    	return $this->belongsTo(Loan::class,'loanID');
    }

    protected function book()
    {
    	return $this->belongsTo(Book::class,'bookID');
    }
}
