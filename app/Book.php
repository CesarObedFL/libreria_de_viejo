<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Classification;

class Book extends Model
{
    //protected $primaryKey = 'ISBN';

    protected $fillable = ['ISBN','title','author','editorial',
                        'classification','genre','collection'];

    public $timestamps = false;

    protected $table = 'books';

    public function features() 
    {
        return $this->hasMany('App\Feature', 'book_id', 'id');
    }

    public function classification() 
    {
        return $this->hasOne('App\Classification', 'id', 'classification');
        //return $this->hasOne(Classification::class);
    }

    public function getClassification($id)
    {    
        $CLASS = Classification::findOrFail($id);
        return $CLASS->class;
    }

    public function getLocation($id)
    {    
        $CLASS = Classification::findOrFail($id);
        return $CLASS->location;
    }

    public function getTotalStock($id) 
    {
        $FEATURES = Book::findOrFail($id)->features;
        $TOTALSTOCK = 0;
        foreach($FEATURES as $feature) {
            $TOTALSTOCK += $feature->stock;
        }
        return $TOTALSTOCK;
    }
}

