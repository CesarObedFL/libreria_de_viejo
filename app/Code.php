<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = ['code'];

    public $timestamps = false;

    protected $table = 'codes';
}
