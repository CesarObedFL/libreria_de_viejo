<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    public $timestamps = false;

    protected $fillable = [ 'invoiceID','product','amount','discount','price', 'type' ];

    public function invoice() 
    {
        return $this->belongsTo(Invoice::class);
    }
}
