<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classification;
use App\Models\User;
use Carbon\Carbon;

class Donation extends Model
{
    protected $table = 'donations';

    protected $fillable = [ 'donor_id', 'type', 'amount', 'date', 'user_id', 'classification_id' ];

    public $timestamps = false;
 
    protected function donor()
    {
    	return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }

    protected function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function classification()
    {
        return $this->hasOne(Classification::class, 'id', 'classification_id')
                    ->withDefault([
                                    'name' => 'sin registrar', 
                                    'type' => 'Libro'
                                ]);
    }

    public function getDate()
    {
    	return Carbon::parse($this->date)->format('d-m-Y');
    }

    public function getType()
    {
        return ($this->type == 'Recibida') ? 'Donador' : 'Beneficiario';
    }
}
