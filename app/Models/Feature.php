<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'book_id', 'edition', 'conditions', 'location',
        'place', 'language', 'price', 'status', 'stock',
    ];

    protected $table = 'features';
    
    public $timestamps = false; 

    public function book() 
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}