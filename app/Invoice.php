<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public $timestamps = false;

    protected $fillable = [
        'userID','date','turn','clientID',
        'subTotal','total','received'
    ];

    public function sales() 
    {
        return $this->hasToMany(Sale::class);
    }
}
