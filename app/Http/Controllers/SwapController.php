<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Swap;
use App\SwapBook;
use App\Book;
use App\Classification;

use Carbon\Carbon;

class SwapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $initDate = '2019-05-14';
        $endDate = Carbon::now()->toDateString();

        $SWAPS = Swap::all();

        if(!is_null($request->initDate) && !empty($request->initDate) &&
            !is_null($request->endDate) && !empty($request->endDate)) {
            $initDate = $request->initDate;
            $endDate = $request->endDate;
            $SWAPS = Swap::whereBetween('date',[$initDate,$endDate])->get();
        }
        
        return view('swaps.index_swaps', compact('SWAPS','initDate','endDate'));
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

        $SWAP = new Swap([
            'date' => Carbon::now()->toDateString(),
            'userID' => Auth::id(),
            'incoming' => 0,
            'outcoming' => 0, 
            'amounttopay' => $request->get('total')
        ]);
        $SWAP->save();

        $OUTBOOKS = 0;
        $PRODUCTS = json_decode($request->get('outProducts'));
        foreach($PRODUCTS as $product) {
            $SWAPBOOK = new SwapBook([
                'swapID' => $SWAP->id,
                'bookID' => $product->id,
                'type' => 'Saliente',
                'status' => 'Registrado'
            ]);
            $SWAPBOOK->save();
            $OUTBOOKS += $product->amount;
            
            // decrementar libros salientes
            $newbb = Book::findOrFail($product->id)->stock - $product->amount;
            Book::where('id',$product->id)->update(['stock' => $newbb]);
        }

        $PRODUCTS = json_decode($request->get('inProducts'));
        $INBOOKS = 0; 
        $STATUS;
        foreach($PRODUCTS as $product) {
            $BOOK = DB::table('books')->where('ISBN',$product->isbn)->first();
            if($BOOK) {
                $NEWSTOCK = $BOOK->stock + $product->amount;
                Book::where('ISBN',$product->isbn)->update(['stock' => $NEWSTOCK]);
                $STATUS = 'Registrado';
            } else {
                $BOOK = new BOOK([
                    'ISBN' => $product->isbn,
                    'title' => $product->title,
                    'author' => 'author',
                    'editorial' => 'editorial',
                    'classification' => 1,
                    'edition' => 'edition',
                    'stock' => $product->amount,
                    'price' => $product->price,
                    'conditions' => 'conditions',
                    'place' => 'Libreria',
                    'location' => 1
                ]);
                $BOOK->save();
                $STATUS = 'Sin Registro';
            }
            
            $SWAPBOOK = new SwapBook([
                'swapID' => $SWAP->id,
                'bookID' => $BOOK->id,
                'type' => 'Entrante',
                'status' => $STATUS
            ]);
            $SWAPBOOK->save();
            $INBOOKS += $product->amount;
        }

        $SWAP->incoming = $INBOOKS;
        $SWAP->outcoming = $OUTBOOKS;
        $SWAP->save();
        $BALANCE = $request->get('pay') - $request->get('total');
        return redirect()->action('SwapController@show',['id' => $SWAP->id])->with(['success' => 'El trueque se ha registrado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$BALANCE]);

    }

    public function show($id)
    {
        $SWAP = Swap::findOrFail($id);
        return view('swaps.info_swap',compact('SWAP'));
    }

    public function edit($id)
    {
        $SWAP = Swap::findOrFail($id);
        if ($SWAP->inbooks->where('status','Sin Registro')->count() > 0) {
            $SBOOK = $SWAP->inbooks->where('status','Sin Registro')->first()->book;
            $CLASSES = Classification::orderBy('class')->where('type',1)->get();
            return view('swaps.register_swaped_book', compact('SBOOK','id','CLASSES'));
        }
        return redirect()->action('SwapController@show',['id' => $id])->with('edit','No hay libros pendientes por registrar...');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification' => 'required',
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
        SwapBook::where('swapID',$id)->where('bookID',$request->get('bookID'))->update(['status' => 'Registrado']);
        Book::where('ISBN',$request->get('ISBN'))->update($request->except('_token','_method','bookID'));
        return redirect()->action('SwapController@show',$id)->with('edit','El libro pediente se ha registrado exitosamente!...');
    }

    public function destroy($id)
    {
        $SWAP = Swap::findOrFail($id);
        $SWAP->delete();
        return redirect()->action('SwapController@index')->with('delete', 'El trueque se ha eliminado exitosamente!...');
    }

    public function searchbook($isbn) // out books
    {
        //$BOOK = DB::table('books')->where('ISBN',$isbn)->where('stock','>',0)->first();
        $BOOK = DB::table('books')->where('ISBN',$isbn)->first();
        return response()->json([
            'id' => $BOOK->id,
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'price' => $BOOK->price,
            'stock' => $BOOK->stock,
            'amount' => 1
        ]);
    }

    /*
    public function searchinbook($isbn)
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
