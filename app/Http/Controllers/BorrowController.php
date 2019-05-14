<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Borrow;
use App\Book;
use App\Client;
use App\BorrowedBook;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $BORROWS = Borrow::all();
        return view('borrows.index_borrows', compact('BORROWS'));
    }

    public function create()
    {
        $CLIENTS = Client::all()->except(1);
        return view('borrows.create_borrow',compact('CLIENTS'));
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
        return redirect()->action('BorrowController@show',['id' => $BORROW->id])->with('success','El préstamo se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $BORROW = Borrow::findOrFail($id);
        return view('borrows.info_borrow',compact('BORROW'));
    }
    
    public function edit($id)
    {
        $BORROW = Borrow::findOrFail($id);
        return view('borrows.devolution',compact('BORROW'));
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
        return redirect()->action('BorrowController@show',['id' => $BORROW->id])->with(['success' => 'La devolución se ha registrado exitosamente!...', 'balancedue' => 'El cambio de la operación es: '.$BALANCE]);
    }

    public function destroy($id)
    {
        //
    }

    public function searchbook($isbn)
    {
        $BOOK = DB::table('books')->where('ISBN',$isbn)->where('stock','>',0)->first();
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
