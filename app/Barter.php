<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barter extends Model
{
    protected $table = 'barters';

    protected $fillable = [
        'date','userID','in','out','amount'
    ];

    // public $timestamps = false;
}
