<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';
    public $timestamps = false; 

    protected $fillable = [
        'book_id','edition','conditions','place',
        'language','price','status','stock',
    ];

    protected function books() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /*
    protected function get()
    {

    }
    */
}