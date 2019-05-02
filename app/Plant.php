<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['name', 'price', 'image', 'tips', 'stock', 'classification'];

    public $timestamps = false;

    protected $table = 'plants';

    public function classification() 
    {
        return $this->hasOne('App\Classification', 'ID', 'classification');
        //return $this->hasOne(Classification::class);
    }

    public function getClassification($ID)
    {    
        $CLASS = Classification::findOrFail($ID);
        return $CLASS->class;
    }

    public function getInfo()
    {
        return $this->name.' :: Precio: $'.$this->price;
    }

}
