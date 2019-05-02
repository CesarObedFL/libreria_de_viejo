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
            'bookID' => $BOOK->ID,
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

    public function show($ID)
    {
        $BOOK = Book::findOrFail($ID);
        return view('books.info_book', compact('BOOK'));
    }

    public function edit($ID)
    {
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        $BOOK = Book::findOrFail($ID);
        return view('books.edit_book', compact('BOOK','ID','CLASSES'));
    }

    public function update(Request $request, $ID)
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
        
        Book::where('ID',$ID)->update($request->except('_token','_method'));
        return redirect()->action('BookController@show',$ID)->with('edit','El libro se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $BOOK = Book::findOrFail($ID);
        $BOOK->delete();
        return redirect()->action('BookController@index')->with('delete', 'El libro se ha eliminado exitosamente!...');
    }

    public function updateStock(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            //'ISBN' => 'required|unique:books',
            'stock' => 'required|numeric|min:1',
            'featureID' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Feature::where('ID',$request->get('featureID'))->update($request->except('_token','_method','bookID','featureID'));
        
        return redirect()->action('BookController@show',$request->get('bookID'))->with('edit','El libro se ha actualizado exitosamente!...');
    }

    public function search(Request $request)
    {
        $ISBN = $request->isbn;
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();

        $BOOK = DB::table('books')->where('ISBN',$ISBN)->first();
        if($BOOK) {
            $BOOK = Book::findOrFail($BOOK->ID);
            return view('books.register_book', compact('BOOK','CLASSES'))->with('edit','El libro ya se encuentra registrado!...');
            
        } else { // PARA CREAR UN LIBRO NUEVO
            return view('books.create_new_book', compact('ISBN','CLASSES'));
        }
    }
}
