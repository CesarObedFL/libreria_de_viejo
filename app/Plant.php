<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['name', 'price', 'image', 'tips', 'stock', 'classification'];

    public $timestamps = false;

    protected $table = 'plants';

}
