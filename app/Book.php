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
        return $this->hasMany('App\Feature','bookID','ID');
    }

    public function classification()
    {
        return $this->hasOne('App\Classification','ID','classification');
        //return $this->hasOne(Classification::class);
    }

    public function getClassification($ID)
    {    
        $CLASS = Classification::findOrFail($ID);
        return $CLASS->class;
    }

    public function getLocation($ID)
    {    
        $CLASS = Classification::findOrFail($ID);
        return $CLASS->location;
    }

    public function getTotalStock($ID) 
    {
        $FEATURES = Book::findOrFail($ID)->features;
        $TOTALSTOCK = 0;
        foreach($FEATURES as $feature) {
            $TOTALSTOCK += $feature->stock;
        }
        return $TOTALSTOCK;
    }
}

