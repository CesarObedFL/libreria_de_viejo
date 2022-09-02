<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Feature;
use App\Models\Book;

class FeatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function newFeature($book)
    {
        return view('features.create_feature', [ 'bookID' => Book::findOrFail($book)->id ]);
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
        return view('books.show_book', [ 'BOOK' => Book::findOrFail($request->bookID) ])->with('success','La entrada del libro se ha creado exitosamente!...');
    }

    public function show($id)
    {
        return view('books.show_book', [ 'BOOK' => Book::findOrFail(Feature::findOrFail($id)->bookID) ]);
    }

    public function edit($id)
    {
        return view('features.edit_feature', [ 'FEATURE' => Feature::findOrFail($id), 'BOOK' => Book::findOrFail($FEATURE->bookID) ]);
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
        return redirect()->action([ BookController::class, 'show'], $BOOK->id)->with('edit','La entrada del libro se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $FEATURE = Feature::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
