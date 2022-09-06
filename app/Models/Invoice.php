<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $table = 'invoices';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'date', 'shift', 'client_id',
        'subtotal', 'total', 'received'
    ];

    public function sales() 
    {
        return $this->hasMany(Sale::class, 'invoice_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function get_date()
    {
        return Carbon::parse($this->date)->format('d/m/Y');
    }
}
