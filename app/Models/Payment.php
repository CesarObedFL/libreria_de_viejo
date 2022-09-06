<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $table = 'payments';

    protected $fillable = [ 'user_id', 'date', 'amount', 'owed' ];

    public $timestamps = false;
}
