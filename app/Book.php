<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Classification;

class Book extends Model
{
    protected $fillable = ['ISBN','title','author','editorial',
                        'classification','genre','collection'//];
                        // BOOK FEATURES
                        ,'edition','conditions','location','place',
                        'price','borrowedbooks','stock'];

    public $timestamps = false;

    protected $table = 'books';

    public function features()
    {
        return $this->hasMany('App\Feature','bookID','id')->withDefault();
    }

    public function classification()
    {
        return $this->hasOne('App\Classification','id','classification');
    }

    public function getClassification($id)
    {    
        $CLASS = Classification::find($this->classification);
        if(!$CLASS)
            return 'eliminada';
        return $CLASS->class;
    }

    public function getLocation()
    {
        return (!$this->location ) ? 'Bodega' : $this->location;
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

    public function getStockState()
    {
        return (!$this->stock) ? 'empty' : 'full';
    }
}

