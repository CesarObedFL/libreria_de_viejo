<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\User;
use App\Pay;
use App\Code;

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
    public function destroy($id){}
    
    public function edit($id) // pay
    {
        if(Auth::user()->isAdmin()) {
            $USER = User::findOrFail((integer)$id);
            $OWED = DB::table('pays')->where('userID',$id)->SUM('owed');
            return view('admin.cut.pay',compact('USER','OWED'));
        }
        return redirect()->action('HomeController@index');
    }
    
    public function update(Request $request, $id) // update pays
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

    public function cut(Request $request) 
    {
        if(Auth::user()->isAdmin()) {
            $initDate = '2018-11-14';
            $endDate = Carbon::now()->toDateString();

            if(!is_null($request->initDate) && !empty($request->initDate) &&
                !is_null($request->endDate) && !empty($request->endDate)) {
                $initDate = $request->initDate;
                $endDate = $request->endDate;
            }

            $DATA = DB::select(DB::raw(
                "SELECT name AS Vendedor, users.id as userID, 
                    MIN(invoices.date) AS FechaInicial,
                    MAX(invoices.date) AS FechaFinal,
                    SUM(total) AS Monto,
                    SUM(total)/10 AS Comision,
                    (SELECT SUM(amounttopay) FROM swaps s WHERE s.userID = users.id AND s.date BETWEEN '$initDate' AND '$endDate') montoDeTrueques,
                    (SELECT SUM(amount) FROM borrows b WHERE b.userID = users.id AND b.inDate BETWEEN '$initDate' AND '$endDate') montoDePrestamos,
                    (SELECT SUM(owed) FROM pays p WHERE p.userID = users.id AND p.date BETWEEN '$initDate' AND '$endDate') adeudo,
                    (SELECT SUM(amount) FROM pays p WHERE p.userID = users.id AND p.date BETWEEN '$initDate' AND '$endDate') montoPagado,
                    (SELECT COUNT(*) FROM sales s JOIN invoices i ON s.invoiceID = i.id WHERE i.userID = users.id AND s.type = 1 AND i.date BETWEEN '$initDate' AND '$endDate') librosVendidos,
                    (SELECT COUNT(*) FROM sales s JOIN invoices i ON s.invoiceID = i.id WHERE i.userID = users.id AND s.type = 2 AND i.date BETWEEN '$initDate' AND '$endDate') plantasVendidas,
                    COUNT(*) AS CantidadVentas
                FROM invoices, users 
                WHERE invoices.userID = users.id 
                    AND invoices.date BETWEEN '$initDate' AND '$endDate'  
                 GROUP BY userID
                 ORDER BY invoices.date"
                ));

            $TOTALS = array(
                'saledBooks' => 0,
                'saledPlants' => 0,
                'totalSales' => 0,
                'swapsTotal' => 0,
                'borrowsTotal' => 0,
                'total' => 0,
                'subtotal' => 0,
                'ttotal' => 0,
                'comissions' => 0
            );

            foreach ($DATA as $data) {
                $TOTALS['saledBooks'] += $data->librosVendidos;
                $TOTALS['saledPlants'] += $data->plantasVendidas;
                $TOTALS['totalSales'] += $data->CantidadVentas;
                $TOTALS['swapsTotal'] += $data->montoDeTrueques;
                $TOTALS['borrowsTotal'] += $data->montoDePrestamos;
                $TOTALS['total'] += $data->Monto;
                $TOTALS['comissions'] += $data->Comision;
            }
            $TOTALS['subtotal'] += $TOTALS['total'] + $TOTALS['swapsTotal'];
            $TOTALS['ttotal'] += $TOTALS['subtotal'] + $TOTALS['borrowsTotal'];
            
            return view('admin.cut.index',compact('DATA','TOTALS','initDate','endDate'));
        }
        return redirect()->action('HomeController@index');
    }

    public function barcodes()
    {
        if(Auth::user()->isAdmin()) {
            $CODE ='code';
            return view('admin.barcodes.index');
        }
        return redirect()->action('HomeController@index');
    }

    public function pdf(Request $request) 
    {
        if(Auth::user()->isAdmin()) {
            $validator = Validator::make($request->all(), [
                'pages' => 'required|integer|between:1,5'
            ]);

            $CODES = array();
            $MIN = 1000000000; 
            $MAX = 9999999999;
            $PAGES = $request->pages;
            $TOTALROWS = (23 * $PAGES) - 1; // 23 rows of codes per pages | the last page 22 rows...
            $CODESPERPAGE = (115 * $PAGES) - 5; // 115 codes per page -5 codes for the last page...

            $BOOKS = json_decode($request->get('books'));
            $counter = 0;
            foreach($BOOKS as $book) {
                for($i = 0; $i < $book->amount; $i++) {
                    array_push($CODES,$book->isbn);
                    $counter++;
                }
            }

            for($i = $counter; $i < $CODESPERPAGE;) {
                $randISBN = Rand($MIN,$MAX);
                if (!DB::table('codes')->where('code',$randISBN)->exists()){
                    array_push($CODES,$randISBN);
                    Code::create(['code' => $randISBN]);
                    $i++;
                }
            }

            $pdf = \PDF::loadView('admin.barcodes.codes',compact('PAGES','CODES', 'TOTALROWS'));
            return $pdf->download('barcodes.pdf');
        }
        return redirect()->action('HomeController@index');
    }

    public function searchbook($title)
    {
        $BOOK = DB::table('books')->where('title',$title)->first();
        return response()->json([
            'id' => $BOOK->id,
            'isbn' => $BOOK->ISBN,
            'title' => $BOOK->title,
            'amount' => 1
        ]);
    }
}
