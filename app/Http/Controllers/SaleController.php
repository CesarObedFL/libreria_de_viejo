<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Client;
use App\Plant;

class SaleController extends Controller
{
    //$BooksToSell = collect();

    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
        return "aqui ando:" + $id;
    }

    public function books() 
    {
        $CLIENTS = Client::all();
        return view('sales.books.saleBooks', compact('CLIENTS'));
    }

    public function searchBook(Request $request)
    {
        $BOOK = DB::table('books')->where('ISBN',$request->search_isbn)->first();
        //$BooksToSell->push($BOOK);
        $CLIENTS = Client::all();
        return view('sales.books.saleBooks',compact('CLIENTS','BOOK'));
    }

    public function plants() 
    {
        $PLANTS = Plant::all();
        $CLIENTS = Client::all();
        return view('sales.plants.salePlants', compact('CLIENTS','PLANTS'));
    }

    public function searchPlant(Request $request)
    {
        //dd(explode('_',$request));
        $ID = explode('_',$request);
        $ID = explode('=',$ID[1]);
        $PLANT = DB::table('plants')->where('id',$ID[1])->first();
        //$PLANT = DB::table('plants')->where('id',$request->product)->first();
        $PLANTS = Plant::all();
        $CLIENTS = Client::all();
        return view('sales.plants.salePlants',compact('CLIENTS','PLANTS','PLANT'));
    }
}
