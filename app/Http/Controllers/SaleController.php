<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\Client;
use App\Models\Plant;
use App\Models\Book;
use App\Models\Invoice;
use App\Models\Sale;
use App\Models\Payment;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start_date = '2019-05-14';
        $end_date = Carbon::now()->toDateString();

        $invoices = Invoice::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $invoices = Invoice::whereBetween('date',[ $start_date, $end_date ])->get();
        }
        return view('sales.index', [ 'invoices' => $invoices, 'start_date' => $start_date, 'end_date' => $end_date ]);
    }

    public function create()
    {
        return view('sales.realize', [ 'clients' => Client::all(), 'plants' => Plant::all()->where('stock','>',0) ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'total' => 'required|numeric',
            'payment'  => 'required|numeric',
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $invoice = new Invoice ([
            'user_id' => Auth::id(),
            'date' => Carbon::now()->toDateString(),
            'shift' => $this->get_current_shift(), 
            'client_id' => $request->get('client_id'),
            'subtotal' => 0,
            'total' => 0,
            'received' => $request->get('payment')
        ]);
        $invoice->save();

        $products = json_decode($request->get('products'));
        $subtotal = 0;
        $total = 0; 
        $product_total = 0;
        foreach($products as $product) {
            Sale::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'amount' => $product->amount,
                'discount' => $product->discount,
                'price' => $product->price,
                'type' => $product->type
            ]);

            $subtotal += $product_total = $product->price * $product->amount;
            $total += $product_total - ($product_total * ($product->discount/100));
            
            if($product->type === 1) {
                $stock = DB::table('books')->where('ISBN', $product->id)->first()->stock;
                Book::where('ISBN', $product->id)->update(['stock' => ($stock -= $product->amount)]);

            } else if($product->type == 2) {
                $plant = Plant::findOrFail($product->id);
                $plant->stock -= $product->amount;
                $plant->save();
            }
        }
        Invoice::where('id', $invoice->id)->update(['subtotal' => $subtotal, 'total' => $total]);
        $comission = $total/10;
 
        DB::table('payments')->updateOrInsert(
            ['user_id' => Auth::id()],
            ['date' => Carbon::now()->toDateString(), 'owed' => $comission]
        );
        
        $balance = $request->get('payment') - $total;
        return redirect()->action([ SaleController::class, 'show' ], $invoice->id)->with(['success' => 'La venta se ha realizado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$balance]);
    }

    public function show($id) 
    { 
        return view('sales.show', [ 'invoice' => Invoice::findOrFail($id) ]);
    }

    public function searchbook($isbn)
    {
        $book = DB::table('books')->where('ISBN',$isbn)->first();
        return response()->json([
            'id' => $book->ISBN, 
            'name' => $book->title,
            'amount' => 1,
            'discount' => 0,
            'price' => $book->price,
            'stock' => $book->stock,
            'type' => 1
        ]);
    }

    public function searchplant($id)
    {
        $plant = DB::table('plants')->where('id',$id)->first();
        return response()->json([
            'id' => $plant->id,
            'name' => $plant->name,
            'amount' => 1,
            'discount' => 0,
            'price' => $plant->price,
            'stock' => $plant->stock,
            'type' => 2
        ]);
    }

    // turno laboral
    private function get_current_shift()
    {
        $today = Carbon::now();
        if($today->dayOfWeek == 0) // sunday
            return 'D';
        else if($today->dayOfWeek == 6) // saturday
            return 'S';
        else if($today->hour < 14) // morning
            return 'M';
        else if($today->hour >= 14) // evening
            return 'V';
    }   
} 
