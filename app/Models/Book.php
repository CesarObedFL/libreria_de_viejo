<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['ISBN','title','author','editorial',
                        'classification_id','genre','collection'//];
                        // BOOK FEATURES
                        ,'edition','conditions','location','place',
                        'price','borrowed_books','stock'];

    public $timestamps = false;

    protected $table = 'books';

    public function features()
    {
        return $this->hasMany(Feature::class, 'book_id', 'id')->withDefault();
    }

    public function classification()
    {
        return $this->hasOne(Classification::class, 'id', 'classification_id')
                    ->withDefault([
                                    'name' => 'eliminada o sin registrar', 
                                    'type' => 'Libro'
                                ]);
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

