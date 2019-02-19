<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bartering extends Model
{
    protected $table = 'barterings';

    public $timestamps = false;

    protected $fillable = [
        'date','userID','in','out','amounttopay'
    ];

}
