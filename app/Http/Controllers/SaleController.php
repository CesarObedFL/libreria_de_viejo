<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Client;
use App\Plant;
use App\Invoice;
use App\Sale;


class SaleController extends Controller
{
    public function index() 
    { 
        $INVOICES = Invoice::all();
        return view('sales.index',compact('INVOICES'));
    }

    public function create()
    {
        $PLANTS = Plant::all();
        $CLIENTS = Client::all();
        return view('sales.realize', compact('CLIENTS','PLANTS'));
    }
    
    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($ID) 
    { 
        // por user_ID y todas (administrador)
    }

    public function edit($ID)
    { 
        //
    }

    public function update(Request $request, $ID)
    { 
        //
    }

    public function destroy($ID) 
    { 
        //
    }

    public function books()     {
        $CLIENTS = Client::all();
        return view('sales.books.sale', compact('CLIENTS'));
    }

    public function searchBook(Request $request)
    {
        $BOOK = DB::table('books')->where('ISBN',$request->ISBN)->first();
        return response()->json([
            'ID' => $BOOK->ISBN, 
            'name' => $BOOK->title,
            'price' => '100',
            'stock' => '1',
            'type' => 1
        ]);
    }

    public function plants()     {
        $PLANTS = Plant::all();
        $CLIENTS = Client::all();
        return view('sales.plants.salePlants', compact('CLIENTS','PLANTS'));
    }

    public function searchPlant(Request $request)
    {
        $PLANT = DB::table('plants')->where('ID',$request->plantID)->first();
        return response()->json([
            'ID' => $PLANT->ID,
            'name' => $PLANT->name,
            'price' => $PLANT->price,
            'stock' => $PLANT->stock,
            'type' => 2
        ]);
    }
} 
