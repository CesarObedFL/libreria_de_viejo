<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $this->hasMany('App\Sale','invoiceID','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userID');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'clientID');
    }

    public function getDate()
    {
        $DATE = Carbon::parse($this->date);
        return $DATE->format('d/m/Y');
    }
}
