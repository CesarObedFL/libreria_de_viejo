<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Feature;
use App\Book;

class FeatureController extends Controller
{

    public function index()
    {
        //
    }

    public function create() 
    {
        //
    }

    public function newFeature($book)
    {
        $bookID = Book::findOrFail($book)->ID;
        return view('features.create_feature', compact('bookID'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required',
            'conditions' => 'required',
            'place' => 'required',
            'language' => 'required',
            'price' => 'required|min:5|numeric',
            //'status' => 'required',
            'stock' => 'required|min:0|numeric',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::create($request->all());
        //return redirect()->back()->with('success','La entrada del libro se ha creado exitosamente!...'); 
        $BOOK = Book::findOrFail($request->bookID);
        return view('books.info_book', compact('BOOK'))->with('success','La entrada del libro se ha creado exitosamente!...');
    }

    public function show($ID)
    {
        $BOOK = Book::findOrFail(Feature::findOrFail($ID)->bookID);
        return view('books.info_book', compact('BOOK'));
    }

    public function edit($ID)
    {
        $FEATURE = Feature::findOrFail($ID);
        $BOOK = Book::findOrFail($FEATURE->bookID);
        //$BOOK = Book::findOrFail(Feature::findOrFail($ID)->book_ID);
        return view('features.edit_feature', compact('FEATURE','ID','BOOK'));
    }

    public function update(Request $request, $ID)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required',
            'conditions' => 'required',
            'place' => 'required',
            'language' => 'required',
            'price' => 'required|min:5|numeric',
            'status' => 'required',
            'stock' => 'required|min:0|numeric',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::where('ID',$ID)->update($request->except('_token','_method'));
        $BOOK = Book::findOrFail(Feature::findOrFail($ID)->bookID);
        return redirect()->action('BookController@show',$BOOK->ID)->with('edit','La entrada del libro se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $FEATURE = Feature::findOrFail($ID)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
