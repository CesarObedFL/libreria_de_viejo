<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;
use App\Models\Plant;

class Sale extends Model
{
    protected $table = 'sales';

    public $timestamps = false;

    protected $fillable = [ 'invoice_id', 'product_id', 'amount', 'discount', 'price', 'type' ];

    public function invoice() 
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }

    public function soldProduct()
    {
        if ( $this->type == 'Libro' ) {
            return Book::where('ISBN', $this->product_id)->first()->title;
        }
        
        return Plant::findOrFail($this->product_id)->name;
    }
}
