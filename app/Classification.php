<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = [
        'class','location','type'
    ];

    protected $table = 'classifications';

    public $timestamps = false;

    public function books()
    {
    	return $this->hasMany('App\Book', 'classification', 'id');
    }
}
