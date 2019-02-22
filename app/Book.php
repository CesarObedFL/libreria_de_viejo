<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //protected $primaryKey = 'ISBN';

    protected $fillable = ['ISBN','title','author','editorial',
                        'classification','genre','saga','collection','stock'];

    public $timestamps = false;

    protected $table = 'books';

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function classification()
    {
   	    return $this->belongsTo(Classification::class, 'clasificacion');
    }
}
