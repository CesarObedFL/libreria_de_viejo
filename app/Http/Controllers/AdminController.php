<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Payment;
use App\Models\Code;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit($id) // payment
    {
        if(Auth::user()->isAdmin()) {
            return view('admin.cut.payment', [ 'user' => User::findOrFail($id), 'owed' => DB::table('payments')->where('user_id', $id)->SUM('owed')]);
        }
        return redirect()->action([ HomeController::class, 'index' ]);
    }
    
    public function update(Request $request, $id) // update payments
    {
        $validator = Validator::make($request->all(), [
            'owed' => 'required|numeric',
            'payment'  => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $payment = DB::table('payments')->where('user_id', $id)->first();
        Payment::where('id', $payment->id)->update([
            'date' => Carbon::now()->toDateString(), 
            'amount' => $payment->amount + $request->get('payment'), 
            'owed' => $request->get('owed') - $request->get('payment')
        ]);
        return redirect()->action([ AdminController::class, 'cut' ])->with('success', 'El pago se ha realizado exitosamente!...');
    }

    public function cut(Request $request) 
    {
        if(Auth::user()->isAdmin()) {
            $start_date = '2018-11-14';
            $end_date = Carbon::now()->toDateString();

            if(!is_null($request->start_date) && !empty($request->start_date) &&
                !is_null($request->end_date) && !empty($request->end_date)) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
            }

            $box_cutting = DB::select(DB::raw(
                "SELECT name AS seller, users.id as user_id, 
                    MIN(invoices.date) AS start_date,
                    MAX(invoices.date) AS end_date,
                    SUM(total) AS amount,
                    SUM(total)/10 AS comission,
                    (SELECT SUM(amount_to_pay) FROM swaps s WHERE s.user_id = users.id AND s.date BETWEEN '$start_date' AND '$end_date') swaps_amount,
                    (SELECT SUM(amount) FROM borrows b WHERE b.user_id = users.id AND b.in_date BETWEEN '$start_date' AND '$end_date') borrows_amount,
                    (SELECT SUM(owed) FROM payments p WHERE p.user_id = users.id AND p.date BETWEEN '$start_date' AND '$end_date') owe,
                    (SELECT SUM(amount) FROM payments p WHERE p.user_id = users.id AND p.date BETWEEN '$start_date' AND '$end_date') paid_amount,
                    (SELECT COUNT(*) FROM sales s JOIN invoices i ON s.invoice_id = i.id WHERE i.user_id = users.id AND s.type = 1 AND i.date BETWEEN '$start_date' AND '$end_date') sold_books,
                    (SELECT COUNT(*) FROM sales s JOIN invoices i ON s.invoice_id = i.id WHERE i.user_id = users.id AND s.type = 2 AND i.date BETWEEN '$start_date' AND '$end_date') sold_plants,
                    COUNT(*) AS sales_amount
                FROM invoices, users 
                WHERE invoices.user_id = users.id 
                    AND invoices.date BETWEEN '$start_date' AND '$end_date'  
                 GROUP BY user_id
                 ORDER BY invoices.date"
                ));

            $totals = array(
                'sold_books' => 0,
                'sold_plants' => 0,
                'sales_total' => 0,
                'swaps_total' => 0,
                'borrows_total' => 0,
                'total' => 0,
                'subtotal' => 0,
                'ttotal' => 0,
                'comissions' => 0
            );

            foreach ($box_cutting as $data) {
                $totals['sold_books'] += $data->sold_books;
                $totals['sold_plants'] += $data->sold_plants;
                $totals['sales_total'] += $data->sales_amount;
                $totals['swaps_total'] += $data->swaps_amount;
                $totals['borrows_total'] += $data->borrows_amount;
                $totals['total'] += $data->amount;
                $totals['comissions'] += $data->comission;
            }
            $totals['subtotal'] += $totals['total'] + $totals['swaps_total'];
            $totals['ttotal'] += $totals['subtotal'] + $totals['borrows_total'];
            
            return view('admin.cut.index', [ 'box_cutting' => $box_cutting, 'totals' => $totals, 'start_date' => $start_date, 'end_date' => $end_date ]);
        }
        return redirect()->action([ HomeController::class, 'index' ]);
    }

    public function barcodes()
    {
        if(Auth::user()->isAdmin()) {
            return view('admin.barcodes.index');
        }
        return redirect()->action([ HomeController::class, 'index' ]);
    }

    public function pdf(Request $request) 
    {
        if(Auth::user()->isAdmin()) {
            $validator = Validator::make($request->all(), [
                'pages' => 'required|integer|between:1,5'
            ]);

            $codes = array();
            $min = 1000000000; 
            $max = 9999999999;
            $pages = $request->pages;
            $total_rows = (23 * $pages) - 1; // 23 rows of codes per pages | the last page 22 rows...
            $codes_per_page = (115 * $pages) - 5; // 115 codes per page -5 codes for the last page...

            $books = json_decode($request->get('books'));
            $counter = 0;
            foreach($books as $book) {
                for($i = 0; $i < $book->amount; $i++) {
                    array_push($codes, $book->isbn);
                    $counter++;
                }
            }

            for($i = $counter; $i < $codes_per_page;) {
                $rand_ISBN = Rand($min, $max);
                if (!DB::table('codes')->where('code', $rand_ISBN)->exists()){
                    array_push($codes, $rand_ISBN);
                    Code::create(['code' => $rand_ISBN]);
                    $i++;
                }
            }

            $pdf = \PDF::loadView('admin.barcodes.codes', [ 'pages' => $pages, 'codes' => $codes, 'total_rows' => $total_rows ]);
            return $pdf->download('barcodes.pdf');
        }
        return redirect()->action([ HomeController::class, 'index' ]);
    }

    public function searchbook($title)
    {
        $book = DB::table('books')->where('title', $title)->first();
        return response()->json([
            'id' => $book->id,
            'isbn' => $book->ISBN,
            'title' => $book->title,
            'amount' => 1
        ]);
    }
}
