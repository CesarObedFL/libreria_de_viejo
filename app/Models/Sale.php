<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    public $timestamps = false;

    protected $fillable = [ 'invoiceID','productID','amount','discount','price', 'type' ];

    public function invoice() 
    {
        return $this->belongsTo(Invoice::class);
    }
}
