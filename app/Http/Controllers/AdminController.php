<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use App\User;
use App\Pay;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    
    public function edit($id)
    {
        $USER = User::findOrFail((integer)$id);
        $OWED = DB::table('pays')->where('userID',$id)->SUM('owed');
        return view('admin.cut.pay',compact('USER','OWED'));
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'owed' => 'required|numeric',
            'pay'  => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $PAY = DB::table('pays')->where('userID',(integer)$id)->first();
        Pay::where('id',$PAY->id)->update([
            'date' => Carbon::now()->toDateString(), 
            'amount' => $PAY->amount + $request->get('pay'), 
            'owed' => $request->get('owed') - $request->get('pay')
        ]);
        return redirect()->action('AdminController@cut')->with('success','El pago se ha realizado exitosamente!...');
    }
    
    public function destroy($id){}

    public function cut()
    {
        $DATA = DB::select('SELECT name AS Vendedor, users.id AS userID, 
                    MIN(invoices.date) AS FechaInicial,
                    MAX(invoices.date) AS FechaFinal,
                    SUM(total) AS Monto,
                    SUM(total)/10 AS Comision,
                    (SELECT SUM(amounttopay) FROM swaps t WHERE t.userID = users.id) montoDeTrueques,
                    (SELECT SUM(amount) FROM borrows p WHERE p.userID = users.id) montoDePrestamos,
                    (SELECT SUM(owed) FROM pays p WHERE p.userID = users.id) adeudo,
                    (SELECT SUM(amount) FROM pays p WHERE p.userID = users.id) montoPagado,
                    (SELECT COUNT(*) FROM sales v JOIN invoices f ON v.invoiceID = f.id WHERE f.userID = users.id AND v.type = "Libro") librosVendidos,
                    (SELECT COUNT(*) FROM sales v JOIN invoices f ON v.invoiceID = f.id WHERE f.userID = users.id AND v.type = "Planta") plantasVendidas,
                    COUNT(*) AS CantidadVentas
                FROM invoices, users
                WHERE invoices.userID = users.id 
                 GROUP BY userID 
                 ORDER BY invoices.date');
        return view('admin.cut.index',compact('DATA'));
    }

    public function barcodes()
    {
        return view('admin.barcodes.index');
    }
}
