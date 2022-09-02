<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Classification;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start_date = '2019-05-14';
        $end_date = Carbon::now()->toDateString();

        $DONATIONS = Donation::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $DONATIONS = Donation::whereBetween('date',[$start_date, $end_date])->get();
        }
            
        return view('donations.index_donations', [ 'DONATIONS' => $DONATIONS,'start_date' => $start_date,'end_date' => $end_date ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'donorID' => 'required',
            'amount' => 'required|integer|min:1',
            'classification' => 'required',
            'type' => 'required|integer|min:1|max:2',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $DONATION = new Donation([
            'donorID' => $request->get('donorID'),
            'type' => $request->get('type'),
            'amount' => $request->get('amount'),
            'date' => Carbon::now()->toDateString(),
            'userID' => Auth::id(),
            'classification' => $request->get('classification')
        ]);
        $DONATION->save();
        //Donation::create($request->all());
        return redirect()->action([ DonationController::class, 'index' ])->with('success','La donación se realizó exitosamente!...');
    }

    public function show($id)
    {
        return view('donations.show_donation', [ 'DONATION' => Donation::findOrFail($id) ]);
    }

    public function destroy($id)
    {
        Donation::findOrFail($id)->delete();
        return redirect()->action([ DonationController::class, 'index' ])->with('delete','La donación se elimino exitosamente!...');
    }

    public function receive()
    {
        $TITLE = "Recibir Donación";
        $TYPE = 1;
        return view('donations.create_donation', [ 'TITLE' => $TITLE, 'TYPE' => $TYPE, 'DONORS' => Donor::all(), 'CLASSES' => Classification::orderBy('class')->where('type','Libro')->get() ]);
    }

    public function donate()
    {
        $TITLE = "Realizar Donación";
        $TYPE = 2;
        return view('donations.create_donation', [ 'TITLE' => $TITLE, 'TYPE' => $TYPE, 'DONORS' => Donor::all(), 'CLASSES' => Classification::orderBy('class')->where('type',1)->get() ]);
    }
}
