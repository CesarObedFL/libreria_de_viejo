<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [ 'name', 'price', 'image', 'tips', 'stock', 'classification_id' ];

    public $timestamps = false;

    protected $table = 'plants';

    public function classification()
    {
        return $this->hasOne(Classification::class, 'id', 'classification_id')
                    ->withDefault([
                                    'name' => 'eliminada', 
                                    'type' => 'Libro'
                                ]);
    }

    public function getInfo()
    {
        return $this->name.' :: Precio: $'.$this->price;
    }

}
