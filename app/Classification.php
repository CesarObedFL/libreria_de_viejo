<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'class','location','type'
    ];

    protected $table = 'classifications';

    public $timestamps = false;

    public function book()
    {
    	return $this->hasMany(Book::class, 'ISBN', 'local_key');
    }
}
