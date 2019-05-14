<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Donation;
use App\Donor;
use App\Classification;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $DONATIONS = Donation::all();
        return view('donations.index_donations',compact('DONATIONS'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'donorID' => 'required',
            'amount' => 'required|numeric|min:1',
            'classification' => 'required',
            'type' => 'required|min:1|max:2',
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
        return redirect()->action('DonationController@index')->with('success','La donación se realizó exitosamente!...');
    }

    public function show($id)
    {
        $DONATION = Donation::findOrFail($id);
        return view('donations.info_donation',compact('DONATION'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, Donation $donations)
    {
        //
    }

    public function destroy($id)
    {
        $DONATION = Donation::findOrFail($id);
        $DONATION->delete();
        return redirect('DonationController@index')->action()->with('delete','La donación se elimino exitosamente!...');
    }

    public function receive()
    {
        $TITLE = "Recibir Donación";
        $TYPE = 1;
        $DONORS = Donor::all();
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        return view('donations.create_donation',compact('TITLE','TYPE','DONORS','CLASSES'));
    }

    public function donate()
    {
        $TITLE = "Realizar Donación";
        $TYPE = 2;
        $DONORS = Donor::all();
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        return view('donations.create_donation',compact('TITLE','TYPE','DONORS','CLASSES'));
    }
}
