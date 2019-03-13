<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Book;
use App\Feature;
use App\Classification;

class BookController extends Controller
{
    public function index()
    {
        $BOOKS = Book::all();
        return view('books.index_books', compact('BOOKS'));
    }

    public function create()
    {
        //$CLASSES = Classification::orderBy('class')->where('type',1)->get();
        //return view('books.create_book', compact('CLASSES'));
        return view('books.search_book');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required|unique:books',
            'title' => 'required',
            'author' => 'required',
            'editorial' => 'required',
            'classification' => 'required',
            'genre' => 'nullable',
            'collection' => 'nullable',
            
            //'register' => 'required_if:type,empresa' // requerido si el tipo es un determinado
            
            // BOOK FEATURES
            'edition' => 'required',
            'stock' => 'required|min:1|numeric',
            'price' => 'required|min:5|numeric',
            'conditions' => 'required',
            'place' => 'required',
            'language' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $BOOK = new BOOK([
            'ISBN' => $request->get('ISBN'),
            'title' => $request->get('title'),
            'author' => $request->get('author'),
            'editorial' => $request->get('editorial'),
            'classification' => $request->get('classification'),
            'genre' => $request->get('genre'),
            'collection' => $request->get('collection')
        ]);
        $BOOK->save();

        $FEATURE = new Feature ([
            'book_id' => $BOOK->id,
            'edition' => $request->get('edition'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'conditions' => $request->get('conditions'),
            'place' => $request->get('place'),
            'language' => $request->get('language')
        ]);
        $FEATURE->save();

        //Book::create($request->all());
        return redirect()->action('BookController@index')->with('success', 'El libro se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $BOOK = Book::findOrFail($id);
        return view('books.info_book', compact('BOOK'));
    }

    public function edit($id)
    {
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        $BOOK = Book::findOrFail($id);
        return view('books.edit_book', compact('BOOK','id','CLASSES'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //'ISBN' => 'required|unique:books',
            'title' => 'required',
            'author' => 'required',
            'editorial' => 'required',
            'classification' => 'required',
            'genre' => 'nullable',
            'collection' => 'nullable',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Book::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action('BookController@show',$id)->with('edit','El libro se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $BOOK = Book::findOrFail($id);
        $BOOK->delete();
        return redirect()->action('BookController@index')->with('delete', 'El libro se ha eliminado exitosamente!...');
    }

    public function updateStock(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            //'ISBN' => 'required|unique:books',
            'stock' => 'required|numeric|min:1',
            'feature_id' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Feature::where('id',$request->get('feature_id'))->update($request->except('_token','_method','book_id','feature_id'));
        
        return redirect()->action('BookController@show',$request->get('book_id'))->with('edit','El libro se ha actualizado exitosamente!...');
    }

    public function search(Request $request)
    {
        $ISBN = $request->search_isbn;
        $BOOK = Book::findOrFail(DB::table('books')->where('ISBN',$ISBN)->first()->id);
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        if($BOOK) {
            return view('books.register_book', compact('BOOK','CLASSES'))->with('edit','EL libro ya se encuentra registrado!...');
            
        } else { // PARA CREAR UN LIBRO NUEVO
            return view('books.create_new_book', compact('ISBN','CLASSES'));
        }
    }
}
