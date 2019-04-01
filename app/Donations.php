<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected $table = 'donations';

    protected $fillable = ['donor_id', 'type', 'amount', 'date', 'user_id', 'classification'];

    public $timestamps = false;
}
