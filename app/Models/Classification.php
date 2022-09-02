<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $fillable = ['class','type'];

    protected $table = 'classifications';

    public $timestamps = false;
}
