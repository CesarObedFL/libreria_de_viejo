<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'features';
    public $timestamps = false;

    protected $fillable = [
        'ISBN','edition','conditions','place',
        'language','price','status','amount'
    ];

    protected function books() {
        return false;
        //return $this->belongsTo(Book::class);
    }

}