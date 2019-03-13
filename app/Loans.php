<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loans extends Model
{
    protected $table = 'loans';

    public $timestamps = false;

    protected $fillable = ['amount', 'outDate', 'inDate', 'id_client', 'id_user'];
}
