<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Loan;
use App\Book;
use App\Client;

class LoanController extends Controller
{

    public function index()
    {
        $LOANS = Loan::all();
        return view('loans.index_loans', compact('LOANS'));
    }

    public function create()
    {
        $CLIENTS = Client::all()->except(1);
        return view('loans.create_loan',compact('CLIENTS'));
    }

    public function store(Request $request)
    {
        /*$validator = Validator::make($request->all(), [ 
            'cliendID' => 'required',
            //'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }*/

        $LOAN = new Loan([
            'amount' => '3',
            'outDate' => Carbon::now()->toDateString(),
            'inDate' => Carbon::now()->addDays(15)->toDateString(),
            'clientID' => $request->get('clientID'),
            'userID' => Auth::ID(),
        ]);
        $LOAN->save();
        return redirect()->action('LoanController@index')->with('success','El préstamo se ha registrado exitosamente!...');
        //return redirect()->action('LoanController@index')->with('success','El préstamo se ha registrado exitosamente!...');
    }

    public function show($ID)
    {
        $LOAN = Loan::findOrFail($ID);
        return view('loans.info_loan',compact('LOAN'));
    }
    
    public function edit($ID)
    {
        //
    }

    public function update(Request $request, $ID)
    {
        //
    }

    public function destroy($ID)
    {
        //
    }

    public function searchClientLoans()
    {

        return view('loans.clientLoans');
    }

    public function devolution() 
    {
        return view('loans.devolution');
    }

    public function search(Request $request)
    {
        $BOOK = DB::table('books')->where('ISBN',$request->ISBN)->first();
        return response()->json([
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'stock' => 5//$BOOK-> 
        ]);
    }
}
