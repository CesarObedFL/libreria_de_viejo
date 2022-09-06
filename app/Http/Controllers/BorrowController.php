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

        $borrows = Borrow::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $borrows = Borrow::whereBetween('out_date',[$start_date, $end_date])
                                ->orWhereBetween('in_date',[$start_date, $end_date])
                                ->get();
        }
        return view('borrows.index_borrows', [ 'borrows' => $borrows, 'start_date' => $start_date, 'end_date' => $end_date ]);
    }

    public function create()
    {
        return view('borrows.create_borrow', [ 'clients' => Client::all()->where('type','Interno') ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $borrow = new Borrow([
            'amount_book' => 0,
            'out_date' => Carbon::now()->toDateString(),
            'in_date' => Carbon::now()->addDays(15)->toDateString(),
            'client_id' => $request->get('client_id'),
            'user_id' => Auth::id(),
            'amount' => 0, //$
        ]);
        $borrow->save();

        $total_borrowed_books = 0; 
        $products = json_decode($request->get('products'));
        foreach($products as $product) {
            BorrowedBook::create([
                'borrow_id' => $borrow->id,
                'book_id' => $product->id,
                'amount' => $product->amount,
                'status' => 'Activo',
            ]);
            $total_borrowed_books += $product->amount;
            
            //MODIFICAR STATUS incrementer libros prestados
            $book = Book::findOrFail($product->id);
            $book->borrowed_books += $product->amount;
            $book->stock -= $product->amount;
            $book->save();
            //DB::table('books')->where('id',$product->id)->increment('borrowed_books',$product->amount)
            //DB::table('books')->where('id',$product->id)->decrement('stock',$product->amount);
        }
        $borrow->amount_book = $total_borrowed_books;
        $borrow->save();
        return redirect()->action([ BorrowController::class, 'show' ], $borrow->id)->with('success','El préstamo se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        return view('borrows.show_borrow', [ 'borrow' => Borrow::findOrFail($id) ]);
    }
    
    public function edit($id)
    {
        return view('borrows.devolution', [ 'borrow' => Borrow::findOrFail($id) ]);
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

        $borrow = Borrow::findOrFail($id);
        $borrow->status = 'Entregado';
        $borrow->amount = $request->get('total');
        $balance = $borrow->amount - $request->get('pay');

        $products = json_decode($request->get('products'));
        foreach($products as $product) {
            foreach($borrow->borrowed_books as $bbook) {
                if($bbook->book->ISBN == $product->isbn) {
                    BorrowedBook::where('id',$bbook->id)->update(['status' => 'Entregado']);
                    // decrementar libros prestados, incrementar stock...
                    $book = Book::findOrFail($product->id);
                    $book->borrowed_books -= $product->amount;
                    $book->stock += $product->amount;
                    $book->save();
                }
            }
        }
        $borrow->save();
        return redirect()->action([ BorrowController::class, 'show' ], $borrow->id)->with(['success' => 'La devolución se ha registrado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$balance]);
    }

    public function searchbook($isbn)
    {
        $book = DB::table('books')->where('ISBN',$isbn)->where('stock','>=',0)->first();
        //$BOOK = DB::table('books')->where('ISBN',$isbn);
        return response()->json([
            'id' => $book->id,
            'isbn' => $book->ISBN,
            'title' => $book->title,
            'stock' => $book->stock,
            'amount' => 1
        ]);
    }

    public function searchborrowedbook($isbn)
    {
        $book = DB::table('books')->where('ISBN', $isbn)->where('borrowed_books', '>', 0)->first();
        return response()->json([
            'id' => $book->id,
            'isbn' => $book->ISBN,
            'title' => $book->title,
            'stock' => $book->stock,
            'amount' => 1
        ]);
    }
}
