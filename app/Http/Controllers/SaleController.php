<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Client;
use App\Plant;
use App\Book;
use App\Invoice;
use App\Sale;
use App\Pay;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $initDate = '2019-05-14';
        $endDate = Carbon::now()->toDateString();

        $INVOICES = Invoice::all();

        if(!is_null($request->initDate) && !empty($request->initDate) &&
            !is_null($request->endDate) && !empty($request->endDate)) {
            $initDate = $request->initDate;
            $endDate = $request->endDate;
            $INVOICES = Invoice::whereBetween('date',[$initDate,$endDate])->get();
        }
        return view('sales.index',compact('INVOICES','initDate','endDate'));
    }

    public function create()
    {
        $PLANTS = Plant::all()->where('stock','>',0);
        $CLIENTS = Client::all();
        return view('sales.realize', compact('CLIENTS','PLANTS'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'clientID' => 'required',
            'total' => 'required|numeric',
            'pay'  => 'required|numeric',
            'products' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $INVOICE = new Invoice ([
            'userID' => Auth::id(),
            'date' => Carbon::now()->toDateString(),
            'turn' => $this->turn(), 
            'clientID' => $request->get('clientID'),
            'subTotal' => 0,
            'total' => 0,
            'received' => $request->get('pay')
        ]);
        $INVOICE->save();
        $invoiceID = $INVOICE->id;

        $PRODUCTS = json_decode($request->get('products'));
        $subTotal = 0;
        $total = 0; 
        $productTotal = 0;
        foreach($PRODUCTS as $product) {
            $SALE = new Sale([
                'invoiceID' => $INVOICE->id,
                'productID' => $product->id,
                'amount' => $product->amount,
                'discount' => $product->discount,
                'price' => $product->price,
                'type' => $product->type
            ]);
            $SALE->save();
            $subTotal += $productTotal = $product->price * $product->amount;
            $total += $productTotal - ($productTotal * ($product->discount/100));
            
            if($product->type === 1) {
                $stock = DB::table('books')->where('ISBN',$product->id)->first()->stock;
                Book::where('ISBN',$product->id)->update(['stock' => ($stock -= $product->amount)]);

            } else if($product->type == 2) {
                $PLANT = Plant::findOrFail($product->id);
                $PLANT->stock -= $product->amount;
                $PLANT->save();
            }
        }
        Invoice::where('id',$invoiceID)->update(['subTotal' => $subTotal, 'total' => $total]);
        $COMMISSION = $total/10;
        /*
        $PAY = new Pay([
            'userID' => Auth::id(),
            'date' => Carbon::now()->toDateString(),
            'amount' => 0,
            'owed' => $COMMISSION]);
        $PAY->save();
        */
        DB::table('pays')->updateOrInsert(
            ['userID' => Auth::id()],
            ['date' => Carbon::now()->toDateString(), 'owed' => $COMMISSION]
        );
        $BALANCE = $request->get('pay') - $total;
        return redirect()->action('SaleController@show',$INVOICE->id)->with(['success' => 'La venta se ha realizado exitosamente!...', 'balancedue' => 'El cambio de la operación es: $'.$BALANCE]);
    }

    public function show($id) 
    { 
        $INVOICE = Invoice::findOrFail($id);
        return view('sales.info',compact('INVOICE'));
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

    public function searchbook($isbn)
    {
        //$BOOK = DB::table('books')->where('ISBN',$isbn)->where('stock','>',0)->first();
        $BOOK = DB::table('books')->where('ISBN',$isbn)->first();
        return response()->json([
            'id' => $BOOK->ISBN, 
            'name' => $BOOK->title,
            'amount' => 1,
            'discount' => 0,
            'price' => $BOOK->price,
            'stock' => $BOOK->stock,
            'type' => 1
        ]);
    }

    public function searchplant($id)
    {
        //$PLANT = DB::table('plants')->where('id',$id)->where('stock','>',0)->first();
        $PLANT = DB::table('plants')->where('id',$id)->first();
        return response()->json([
            'id' => $PLANT->id,
            'name' => $PLANT->name,
            'amount' => 1,
            'discount' => 0,
            'price' => $PLANT->price,
            'stock' => $PLANT->stock,
            'type' => 2
        ]);
    }

    private function turn()
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
