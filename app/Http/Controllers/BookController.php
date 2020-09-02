<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use JanDrda\LaravelGoogleCustomSearchEngine\LaravelGoogleCustomSearchEngine;
use Goutte\Client;

use App\Book;
use App\Feature;
use App\Classification;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification' => 'required',
            'genre' => 'nullable|max:20',
            'collection' => 'nullable|max:20',
            // BOOK FEATURES
            'edition' => 'required|max:20', // <--
            'stock' => 'required|integer|min:1', // <--
            'price' => 'required|numeric|min:5|max:9999', // <--
            'conditions' => 'required|max:20', // <--
            'place' => 'required|min:0|max:13', // <--
            'location' => 'required|integer|min:0|max:13', // <--
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
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification' => 'required',
            'genre' => 'nullable|max:20',
            'collection' => 'nullable|max:20',
            // BOOK FEATURES
            'edition' => 'required|max:20', // <--
            'stock' => 'required|numeric|min:1', // <--
            'price' => 'required|numeric|min:5|max:9999', // <--
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
        $book_characteristics;
        $client = new Client();       
        //$crawler = $client->request('GET', 'https://www.elsotano.com/busqueda/listaLibros.php?tipoBus=full&tipoArticulo=&palabrasBusqueda=ISBN');
        $crawler = $client->request('GET', 'https://www.iberlibro.com/servlet/SearchResults?cm_sp=SearchF-_-topnav-_-Results&ds=20&kn='.$ISBN.'&sts=t');

        //$book = $crawler->filter("[class='so-postbookcontent']");
        //$booktitle = $crawler->filter("[class='so-booktitle']");
        //$booktitle = $crawler->filter("[class='product-name']");
        $book_characteristics = $crawler->filter('[id="book-1"]')->each(function ($book) {
            $title = $book->filter('[itemprop="url"]')->first();
            $author = $book->filter('[class="author"]')->first();
            $editorial = $book->filter('[id="publisher"]')->first();
            //$editorial = str_replace('Publicado por ', '', $editorial->text());
            return array($title->text(), $author->text(), $editorial->text());
        });
        //$crawler->filter("[class='so-postbookcontent']")->each(function ($book) {
        //    $booktitle = $book->filter("[class='so-booktitle']")->first();
        //    echo $booktitle->text().'<br>'; 
        //});

        //9789500426404 - EL PRINCIPITO
        //9789875453104 - LA NOCHE


        //$fulltext = new LaravelGoogleCustomSearchEngine(); // initialize
        //$result = $fulltext->getResults('El principito'); // get first 10 results for query 'some phrase' 
        //dd($fulltext->getSearchInformation());

        /*
        $BOOK = DB::table('books')->where('ISBN',$ISBN)->first();
        if($BOOK) {
            $BOOK = Book::findOrFail($BOOK->id);
            return view('books.update_book', compact('BOOK'))->with('edit','El libro ya se encuentra registrado!...');
            
        } else { // CREATE NEW BOOK
        //*/    
            $book_characteristics = $book_characteristics[0];
            $TITLE = $book_characteristics[0];
            $author = $book_characteristics[1];
            $ESPACIOS_AL_FRENTE_DE_LA_EDITORIAL = 43;
            $editorial = substr($book_characteristics[2],$ESPACIOS_AL_FRENTE_DE_LA_EDITORIAL);
            //var_dump($TITLE);
            //echo $TITLE;
            $CLASSES = Classification::orderBy('class')->where('type',1)->get();
            return view('books.create_new_book', compact('ISBN','TITLE','author','editorial','CLASSES'));
        //} */
    }
}
