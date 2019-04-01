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
        $book_id = Book::findOrFail($book)->id;
        return view('features.create_feature', compact('book_id'));
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
            'stock' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::create($request->all());
        //return redirect()->back()->with('success','La entrada del libro se ha creado exitosamente!...'); 
        $BOOK = Book::findOrFail($request->book_id);
        return view('books.info_book', compact('BOOK'))->with('success','La entrada del libro se ha creado exitosamente!...');
    }

    public function show($id)
    {
        $BOOK = Book::findOrFail(Feature::findOrFail($id)->book_id);
        return view('books.info_book', compact('BOOK'));
    }

    public function edit($id)
    {
        $BOOK = Book::findOrFail(Feature::findOrFail($id)->book_id);
        return view('features.edit_feature', compact('FEATURE','id','BOOK'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required',
            'conditions' => 'required',
            'place' => 'required',
            'language' => 'required',
            'price' => 'required|min:5|numeric',
            'status' => 'required',
            'stock' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::where('id',$id)->update($request->except('_token','_method'));
        $BOOK = Book::findOrFail(Feature::findOrFail($id)->book_id);
        return redirect()->action('BookController@show',$BOOK->id)->with('edit','La entrada del libro se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $FEATURE = Feature::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
