<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\Client;
use App\Models\BorrowedBook;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start_date = '2019-05-14';
        $end_date = Carbon::now()->toDateString();

        $BORROWS = Borrow::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $BORROWS = Borrow::whereBetween('outDate',[$start_date, $end_date])
                                ->orWhereBetween('inDate',[$start_date, $end_date])
                                ->get();
        }
        return view('borrows.index_borrows', [ 'BORROWS' => $BORROWS, 'start_date' => $start_date, 'end_date' => $end_date ]);
    }

    public function create()
    {
        return view('borrows.create_borrow', [ 'CLIENTS' => Client::all()->where('type','Interno') ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clientID' => 'required',
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $BORROW = new Borrow([
            'amountbooks' => 0,
            'outDate' => Carbon::now()->toDateString(),
            'inDate' => Carbon::now()->addDays(15)->toDateString(),
            'clientID' => $request->get('clientID'),
            'userID' => Auth::id(),
            'amount' => 0, //$
        ]);
        $BORROW->save();

        $TOTALBORROWEDBOOKS = 0; 
        $PRODUCTS = json_decode($request->get('products'));
        foreach($PRODUCTS as $product) {
            $BORROWEDBOOK = new BorrowedBook([
                'borrowID' => $BORROW->id,
                'bookID' => $product->id,
                'amount' => $product->amount,
                'status' => 'Activo',
            ]);
            $BORROWEDBOOK->save();
            $TOTALBORROWEDBOOKS += $product->amount;
            
            //MODIFICAR STATUS incrementer libros prestados
            $BOOK = Book::findOrFail($product->id);
            $BOOK->borrowedbooks += $product->amount;
            $BOOK->stock -= $product->amount;
            $BOOK->save();
            //DB::table('books')->where('id',$product->id)->increment('borrowedbooks',$product->amount)
            //DB::table('books')->where('id',$product->id)->decrement('stock',$product->amount);
        }
        $BORROW->amountbooks = $TOTALBORROWEDBOOKS;
        $BORROW->save();
        return redirect()->action([ BorrowController::class, 'show' ], $BORROW->id)->with('success','El préstamo se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        return view('borrows.show_borrow', [ 'BORROW' => Borrow::findOrFail($id) ]);
    }
    
    public function edit($id)
    {
        return view('borrows.devolution', [ 'BORROW' => Borrow::findOrFail($id) ]);
    }

    public function update(Request $request, $id) // DEVOLUTION...
    {
        $validator = Validator::make($request->all(), [
            'pay' => 'required|numeric|min:0|max:99999',
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $BORROW = Borrow::findOrFail($id);
        $BORROW->status = 'Entregado';
        $BORROW->amount = $request->get('total');
        $BALANCE = $BORROW->amount - $request->get('pay');

        $PRODUCTS = json_decode($request->get('products'));
        foreach($PRODUCTS as $product) {
            foreach($BORROW->borrowedbooks as $bbook) {
                if($bbook->book->ISBN == $product->isbn) {
                    BorrowedBook::where('id',$bbook->id)->update(['status' => 'Entregado']);
                    // decrementar libros prestados, incrementar stock...
                    $BOOK = Book::findOrFail($product->id);
                    $BOOK->borrowedbooks -= $product->amount;
                    $BOOK->stock += $product->amount;
                    $BOOK->save();
                }
            }
        }
        $BORROW->save();
        return redirect()->action([ BorrowController::class, 'show' ], $BORROW->id)->with(['success' => 'La devolución se ha registrado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$BALANCE]);
    }

    public function searchbook($isbn)
    {
        $BOOK = DB::table('books')->where('ISBN',$isbn)->where('stock','>=',0)->first();
        //$BOOK = DB::table('books')->where('ISBN',$isbn);
        return response()->json([
            'id' => $BOOK->id,
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'stock' => $BOOK->stock,
            'amount' => 1
        ]);
    }

    public function searchborrowedbook($isbn)
    {
        $BOOK = DB::table('books')->where('ISBN',$isbn)->where('borrowedbooks','>',0)->first();
        return response()->json([
            'id' => $BOOK->id,
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'stock' => $BOOK->stock,
            'amount' => 1
        ]);
    }
}
