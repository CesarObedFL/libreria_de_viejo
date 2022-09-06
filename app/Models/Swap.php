<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Swap extends Model
{
    protected $table = 'swaps';

    public $timestamps = false;

    protected $fillable = [
        'date',
        'user_id',
        'incoming_books',     // cantidad de libros entrantes
        'outgoing_books',    // cantidad de libros salientes
        'amount_to_pay'
    ];

	public function swaped_books()
    {
        return $this->hasMany(SwapBook::class, 'swap_id', 'id');
    }

    public function inbooks()
    {
        return $this->hasMany(SwapBook::class, 'swap_id', 'id')->where('type', 'Entrante');
    }

    public function outbooks()
    {
        return $this->hasMany(SwapBook::class, 'swap_id', 'id')->where('type', 'Saliente');
    }

    public function isComplete()
    {
        if($this->inbooks->where('status','Sin Registro')->count() > 0)
            return 'Incompleto';

        return 'Completo';
    }

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getDate()
    {
    	$date = Carbon::parse($this->date);
    	return $date->format('d/m/Y');
    }
}
