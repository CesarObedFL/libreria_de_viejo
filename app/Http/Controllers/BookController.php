<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Book;
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
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        return view('books.create_book', compact('CLASSES'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required',
            'title' => 'required',
            'author' => 'required',
            'editorial' => 'required',
            'classification' => 'required',
            'genre' => 'required',
            'saga' => 'required',
            'collection' => 'required',
            'amount' => 'required|min:1',
            //'register' => 'required_if:type,empresa' // requerido si el tipo es un determinado
            // BOOK FEATURES
            'edition' => 'required',
            'conditions' => 'required',
            'price' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Book::create($request->all());
        return redirect()->action('BookController@index')->with('success', 'El libro se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $BOOK = Book::find($id);
        return view('books.info_book', compact('BOOK'));
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
        $BOOK = Book::findOrFail($id);
        $BOOK->delete();
        return redirect()->action('BookController@index')->with('delete', 'El libro se ha eliminado exitosamente!...');
    }
}
