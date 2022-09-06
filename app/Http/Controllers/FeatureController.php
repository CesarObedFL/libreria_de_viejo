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

    public function newFeature($book_id)
    {
        return view('features.create_feature', [ 'book_id' => Book::findOrFail($book_id)->id ]);
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
        return view('books.show_book', [ 'book' => Book::findOrFail($request->book_id) ])->with('success', 'La entrada del libro se ha creado exitosamente!...');
    }

    public function show($id)
    {
        return view('books.show_book', [ 'book' => Feature::findOrFail($id)->book ]);
    }

    public function edit($id)
    {
        return view('features.edit_feature', [ 'feature' => Feature::findOrFail($id) ]);
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
        $book_id = Feature::findOrFail($id)->book_id;
        return redirect()->action([ BookController::class, 'show'], $book_id)->with('edit', 'La entrada del libro se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        Feature::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
