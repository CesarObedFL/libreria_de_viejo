<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Swap;
use App\Models\SwapBook;
use App\Models\Book;
use App\Models\Classification;

use Carbon\Carbon;

class SwapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start_date = '2019-05-14';
        $end_date = Carbon::now()->toDateString();

        $swaps = Swap::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $swaps = Swap::whereBetween('date', [ $start_date, $end_date ])->get();
        }
        
        return view('swaps.index_swaps', [ 'swaps' => $swaps, 'start_date' => $start_date, 'end_date' => $end_date ]);
    }

    public function create()
    {
        return view('swaps.create_swap');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pay' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'inProducts' => 'required',
            'outProducts' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $swap = new Swap([
            'date' => Carbon::now()->toDateString(),
            'user_id' => Auth::id(),
            'incoming_books' => 0,
            'outgoing_books' => 0, 
            'amount_to_pay' => $request->get('total')
        ]);
        $swap->save();

        $outgoing_books = 0;
        $out_products = json_decode($request->get('outProducts'));
        foreach($out_products as $product) {
            SwapBook::create([
                'swap_id' => $swap->id,
                'book_id' => $product->id,
                'type' => 'Saliente',
                'status' => 'Registrado'
            ]);
            $outgoing_books += $product->amount;
            
            // decrementar libros salientes
            $newbb = Book::findOrFail($product->id)->stock - $product->amount;
            Book::where('id', $product->id)->update(['stock' => $newbb]);
        }

        $in_products = json_decode($request->get('inProducts'));
        $incoming_books = 0; 
        $status = '';
        foreach($in_products as $product) {
            $book = DB::table('books')->where('ISBN',$product->isbn)->first();
            if($book) {
                $new_stock = $book->stock + $product->amount;
                Book::where('ISBN', $product->isbn)->update(['stock' => $new_stock]);
                $status = 'Registrado';
            } else {
                $book = new BOOK([
                    'ISBN' => $product->isbn,
                    'title' => $product->title,
                    'author' => 'author',
                    'editorial' => 'editorial',
                    'classification_id' => 1,
                    'edition' => 'edition',
                    'stock' => $product->amount,
                    'price' => $product->price,
                    'conditions' => 'conditions',
                    'place' => 'Libreria',
                    'location' => 1
                ]);
                $book->save();
                $status = 'Sin Registro';
            }
            
            SwapBook::create([
                'swap_id' => $swap->id,
                'book_id' => $book->id,
                'type' => 'Entrante',
                'status' => $status
            ]);
            $incoming_books += $product->amount;
        }

        $swap->incoming_books = $incoming_books;
        $swap->outgoing_books = $outgoing_books;
        $swap->save();
        $balance = $request->get('pay') - $request->get('total');
        return redirect()->action([ SwapController::class, 'show' ], [ 'id' => $swap->id ])->with([ 'success' => 'El trueque se ha registrado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$balance ]);

    }

    public function show($id)
    {
        return view('swaps.show_swap', [ 'swap' => Swap::findOrFail($id) ]);
    }

    public function edit($id)
    {
        $swap = Swap::findOrFail($id);
        if ( $swap->inbooks->where('status','Sin Registro')->count() > 0 ) {
            $swaped_book = $swap->inbooks->where('status', 'Sin Registro')->first()->book;
            $classes = Classification::orderBy('name')->where('type', 'Libro')->get();
            return view('swaps.register_swaped_book', [ 'swaped_book' => $swaped_book, 'classes' => $classes ]);
        }
        
        return redirect()->action( [ SwapController::class, 'show' ], $swap->id )->with('edit', 'No hay libros pendientes por registrar...');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification_id' => 'required',
            'genre' => 'nullable|max:20',
            'collection' => 'nullable|max:20',
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:9999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|numeric|min:0|max:13' // <--
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        SwapBook::where('swap_id', $id)->where('book_id', $request->get('book_id'))->update(['status' => 'Registrado']);
        Book::where('ISBN',$request->get('ISBN'))->update($request->except('_token','_method','book_id'));
        return redirect()->action([ SwapController::class, 'show' ], $id )->with('edit', 'El libro pendiente se ha registrado exitosamente!...');
    }

    public function destroy($id)
    {
        Swap::findOrFail($id)->delete();
        return redirect()->action([ SwapController::class, 'index' ])->with('delete', 'El trueque se ha eliminado exitosamente!...');
    }

    public function searchbook($isbn) // out books
    {

        $book = DB::table('books')->where('ISBN', $isbn)->first();
        return response()->json([
            'id' => $book->id,
            'isbn' => $book->ISBN,
            'title' => $book->title,
            'price' => $book->price,
            'stock' => $book->stock,
            'amount' => 1
        ]);
    }

    /*
    public function searchingbook($isbn)
    {
        $BOOK = DB::table('books')->where('ISBN',$isbn)->first()
                ->withDefault([
                    'ISBN' => $isbn,
                    'title' => 'title',
                    'author' => 'author',
                    'editorial' => 'editorial',
                    'classification' => 0,
                    // BOOK FEATURES
                    ,'edition' => 'edition',
                    'stock' => 0,
                    'price' => 5.0,
                    'conditions' => 'conditions',
                    'place' => 'Libreria',
                    'location' => 0 // bodega
                ]);
        return response()->json([
            'id' => $BOOK->id,
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'price' => $BOOK->price,
            'stock' => $BOOK->stock,
            'amount' => 1
        ]);
    }
    */
}
