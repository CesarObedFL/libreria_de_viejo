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

    /**
     * función para listar las ventas que se han realizado, 
     * cuenta con el filtro por fechas
     * 
     * @param Request con las fechas de la información a filtrar
     * @return View con la información de las ventas hechas dentro del filtro aplicado y el filtro mismo
     */
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

    /**
     * función para renderizar la vista de venta de productos, libros y plantas
     * 
     * @return View del formulario de venta, se mandan los clientes registrados en la base de datos, así como las plantas con stock mayor a cero
     */
    public function create()
    {
        return view('sales.realize', [ 'clients' => Client::all(), 'plants' => Plant::all()->where('stock','>',0) ]);
    }
    
    /**
     * función para almacenar las ventas realizadas se crean y guardan todos los modelos de datos necesarios para la realización de la venta así como se calcúla la cantidad restante
     * del monto del pago efectuado menos el monto total de los productos
     * 
     * @param Redirect hacía los detalles de la venta realizada junto el mensaje de la operación realizada y, si así sucede, la cantidad restante del pago efectuado al realizar la venta
     */
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
            'shift' => self::get_current_shift(), 
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

    /**
     * función para mostrar los detalles de las ventas realizadas
     * 
     * @param Integer con el $id de la venta a mostrar
     * @return View con la vista y la información
     */
    public function show($id) 
    { 
        return view('sales.show', [ 'invoice' => Invoice::findOrFail($id) ]);
    }

    /**
     * función para mostrar la información de los libros almacenados en la base de datos
     * es empleada por un buscador dentro de la vista de 'realizar venta' para mostrar los libros a vender
     * funciona como una API con operación GET
     * 
     * @param String con el $isbn del libro a buscar, se introduce en un input
     * @return JSON con la información necesaria del libro encontrado
     */
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

    /**
     * función para mostrar la información de las plantas almacenadas en la base de datos
     * como el buscador de libros, es empleado dentro de la vista para realizar ventas para mostrar la información necesaria de las plantas a vender
     * funciona como una operación de API con GET
     * 
     * @param Integer con el $id de la planta a mostrar
     * @return JSON con la información de la planta encontrada
     */
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

    /**
     * función para determinar el turno laboral en el que se esta trabajando, es empleada para registrar las ventas en este mismo controlador
     */
    private static function get_current_shift()
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
