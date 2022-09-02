<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classification;
use App\Models\User;
use Carbon\Carbon;

class Donation extends Model
{
    protected $table = 'donations';

    protected $fillable = ['donorID', 'type', 'amount', 'date', 'userID', 'classification'];

    public $timestamps = false;

    protected function donor()
    {
    	return $this->belongsTo(Donor::class, 'donorID');
    }

    protected function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function getDate()
    {
    	$DATE = Carbon::parse($this->date);
    	return $DATE->format('d-m-Y');
    }

    public function getClass()
    {
    	$CLASS = Classification::find($this->classification);
        if(!$CLASS)
            return 'eliminada';
        return $CLASS->class;
    }

    public function getType()
    {
        return ($this->type == 'Recibida') ? 'Donador' : 'Beneficiario';
    }
}
