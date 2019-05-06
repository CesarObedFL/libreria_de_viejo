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
        return view('books.search_book');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required|unique:books|max:15',
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification' => 'required',
            'genre' => 'nullable|max:20',
            'collection' => 'nullable|max:20',
            // BOOK FEATURES
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:99999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|numeric|min:0|max:13', // <--
            'language' => 'required|max:20'
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
            // BOOK FEATURES
            ,'edition' => $request->get('edition'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'conditions' => $request->get('conditions'),
            'place' => $request->get('place'),
            'location' => $request->get('location'),
        ]);
        $BOOK->save();

        $FEATURE = new Feature ([
            'bookID' => $BOOK->id,
            'edition' => $request->get('edition'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'conditions' => $request->get('conditions'),
            'place' => $request->get('place'),
            'location' => $request->get('location'),
            'language' => $request->get('language')
        ]);
        $FEATURE->save();

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
            // BOOK TABLE
            'ISBN' => 'required|max:15|unique:books,ISBN,'.$id,
            'title' => 'required|max:50',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification' => 'required',
            'genre' => 'nullable|max:20',
            'collection' => 'nullable|max:20',
            // BOOK FEATURES
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:99999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|numeric|min:0|max:13' // <--
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
            'stock' => 'required|numeric|min:1',
            //'featureID' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //Feature::where('id',$request->get('featureID'))->update($request->except('_token','_method','bookID','featureID'));
        $newStock = $request->get('stock');
        Book::where('id',$request->get('bookID'))->update(['stock' => $newStock]);
        return redirect()->action('BookController@show',$request->get('bookID'))->with('edit','El libro se ha actualizado exitosamente!...');
    }

    public function search(Request $request)
    {
        $ISBN = $request->isbn;
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();

        $BOOK = DB::table('books')->where('ISBN',$ISBN)->first();
        if($BOOK) {
            $BOOK = Book::findOrFail($BOOK->id);
            return view('books.update_book', compact('BOOK','CLASSES'))->with('edit','El libro ya se encuentra registrado!...');
            
        } else { // PARA CREAR UN LIBRO NUEVO
            return view('books.create_new_book', compact('ISBN','CLASSES'));
        }
    }
}
