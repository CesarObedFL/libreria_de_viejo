<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Feature;
use App\Book;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $bookID = Book::findOrFail($book)->id;
        return view('features.create_feature', compact('bookID'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:99999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|numeric|min:0|max:13', // <--
            'language' => 'required|max:20'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::create($request->all());
        $BOOK = Book::findOrFail($request->bookID);
        return view('books.info_book', compact('BOOK'))->with('success','La entrada del libro se ha creado exitosamente!...');
    }

    public function show($id)
    {
        $BOOK = Book::findOrFail(Feature::findOrFail($id)->bookID);
        return view('books.info_book', compact('BOOK'));
    }

    public function edit($id)
    {
        $FEATURE = Feature::findOrFail($id);
        $BOOK = Book::findOrFail($FEATURE->bookID);
        return view('features.edit_feature', compact('FEATURE','id','BOOK'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:99999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|numeric|min:0|max:13', // <--
            'language' => 'required|max:20'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::where('id',$id)->update($request->except('_token','_method'));
        $BOOK = Book::findOrFail(Feature::findOrFail($id)->bookID);
        return redirect()->action('BookController@show',$BOOK->id)->with('edit','La entrada del libro se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $FEATURE = Feature::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
