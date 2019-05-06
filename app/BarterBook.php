<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarterBook extends Model
{
	protected $table = 'barter_books';

    protected $fillable = ['barterID', 'bookID', /*'featureID',*/ 'type'];

    public $timestamps = false;
}
