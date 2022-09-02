<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['name', 'price', 'image', 'tips', 'stock', 'classification'];

    public $timestamps = false;

    protected $table = 'plants';

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

    public function getInfo()
    {
        return $this->name.' :: Precio: $'.$this->price;
    }

}
