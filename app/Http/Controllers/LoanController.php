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
use App\BorrowedBook;

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
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }*/
        $LOAN = new Loan([
            'amount' => 0,//$PRODUCTS.length,
            'outDate' => Carbon::now()->toDateString(),
            'inDate' => Carbon::now()->addDays(15)->toDateString(),
            'clientID' => $request->get('clientID'),
            'userID' => Auth::id(),
        ]);
        $LOAN->save();

        $PRODUCTS = json_decode($request->get('products'));
        $amount = 0; 
        foreach($PRODUCTS as $product) {
            $BORROWEDBOOK = new BorrowedBook([
                'loanID' => $LOAN->id,
                'bookID' => $product->id,
                'status' => 'Activo',
            ]);
            $BORROWEDBOOK->save();
            $amount++;
            
            //MODIFICAR STATUS incrementer libros prestados
            //$newbb = Book::findOrFail($product->id)->borrowedbooks + $product->amount;
            //$book = Book::where('ISBN',$product->id)->get();
            //$newbb = $book->borrowedbooks + $product->amount;
            //Book::where('ISBN',$product->id)->update(['borrowedbooks' => $newbb]);

        }
        $LOAN->amount = $amount;
        $LOAN->save();
        return redirect()->action('LoanController@show',['id' => $LOAN->id])->with('success','El préstamo se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $LOAN = Loan::findOrFail($id);
        return view('loans.info_loan',compact('LOAN'));
    }
    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function clients()
    {
        if(!Loan::count())
            return redirect()->action('LoanController@index');

        $CLIENTS = Client::all()->except('1');
        return view('loans.search_client',compact('CLIENTS')); // loans x client
    }

    public function devolution(Request $request)
    {
        $clientID = $request->clientID;
        $LOANS = Loan::where('clientID',$clientID)->get();
        $CLIENT = Client::findOrFail($clientID);
        return view('loans.devolution',compact('CLIENT','LOANS'));
    }

    public function searchbook($isbn)
    {
        $BOOK = DB::table('books')->where('ISBN',$request->ISBN)->first();
        return response()->json([
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'stock' => $BOOK->stock
        ]);
    }
}
