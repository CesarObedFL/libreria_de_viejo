<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use JanDrda\LaravelGoogleCustomSearchEngine\LaravelGoogleCustomSearchEngine;
use Goutte\Client;

use App\Models\Book;
use App\Models\Feature;
use App\Models\Classification;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * función para listar todos los libros registrados en la plataforma
     * 
     * @return View con los datos de los libros a listar
     */
    public function index()
    {
        return view('books.index_books', [ 'books' =>  Book::all() ] );
    }

    /**
     * función para renderizar la vista del buscador de libros
     * 
     * @return View con el buscador de los libros
     */
    public function create()
    {
        return view('books.search_book');
    }

    /**
     * función para almacenar en la base de datos los libros creados
     * 
     * @return Redirect hacia la vista de index con la lista de los libros creados y el mensaje correspondiente de creación
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required|unique:books',
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification_id' => 'required',
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

        $book = new BOOK([
            'ISBN' => $request->get('ISBN'),
            'title' => $request->get('title'),
            'author' => $request->get('author'),
            'editorial' => $request->get('editorial'),
            'classification_id' => $request->get('classification_id'),
            'genre' => $request->get('genre'),
            'collection' => $request->get('collection'),
            // BOOK FEATURES
            'edition' => $request->get('edition'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'conditions' => $request->get('conditions'),
            'place' => $request->get('place'),
            'location' => $request->get('location'),
        ]);
        $book->save();

        Feature::create([
            'book_id' => $book->id,
            'edition' => $request->get('edition'),
            'stock' => $request->get('stock'),
            'price' => $request->get('price'),
            'conditions' => $request->get('conditions'),
            'place' => $request->get('place'),
            'location' => $request->get('location'),
            'language' => $request->get('language')
        ]);

        return redirect()->action([ BookController::class, 'index' ])->with('success', 'El libro se ha registrado exitosamente!...');
    }

    /**
     * función para mostrar el detalle de los libros almacenados
     * 
     * @param Integer con el $id del libro a mostrar
     * @return View con la información del libro a mostrar
     */
    public function show($id)
    {
        return view('books.show_book', [ 'book' => Book::findOrFail($id) ]);
    }

    /**
     * función para mostrar la vista de edición de los libros registrados en la base de datos
     * 
     * @param Integer con el $id del libro a modificar
     * @return View con la información del libro a modificar y las clasificaciones disponibles
     */
    public function edit($id)
    {
        return view('books.edit_book', [ 'book' => Book::findOrFail($id) ,'classes' => Classification::orderBy('name')->where('type','Libro')->get() ]);
    }

    /**
     * función para actualizar la información de los libros almacenados en la base de datos
     * 
     * @param Request con la nueva información del libro a actualizar
     * @param Integer del $id del libro a modificar
     * @return Redirect hacia la vista del detalle de libros con la información ya actualizada
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required|unique:books,ISBN,'.$id,
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'editorial' => 'required|max:30',
            'classification_id' => 'required',
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
        return redirect()->action([ BookController::class, 'show' ], $id)->with('edit','El libro se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar los libros registrados en la base de datos
     * 
     * @param Integer con el $id del libro a eliminar
     * @return Redirect hacia el listado de libros registrados con el mensaje correspondiente
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->action([ BookController::class, 'index' ])->with('delete', 'El libro se ha eliminado exitosamente!...');
    }

    /**
     * función para actualizar el stock de los libros ya registrados en la base de datos
     * 
     * @param Request con la información del stock actualizado
     * @return Redirect a la vista del detalle del libro
     */
    public function updateStock(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'stock' => 'required|numeric|min:1',
            //'featureID' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //Feature::where('id',$request->get('featureID'))->update($request->except('_token','_method','book_id','featureID'));
        $new_stock = $request->get('stock');
        Book::where('id',$request->get('book_id'))->update(['stock' => $new_stock]);
        return redirect()->action([ BookController::class, 'show'] , $request->get('book_id'))->with('edit','El libro se ha actualizado exitosamente!...');
    }

    /**
     * función para buscar libros ya registrados en la base de datos para no registrarlos repetidamente
     * 
     * @param Request con el isbn del libro a buscar en la base de datos
     * @return Redirect hacia la vista de actualización de stock o hacia el registro de nuevos libros, según sea el caso
     */
    public function search(Request $request)
    {
        return view('books.create_new_book', [ 
            'ISBN' => $request->get('isbn'),
            'TITLE' => '', 
            'author' => '', 
            'editorial' => '', 
            'classes' =>  Classification::orderBy('name')->where('type','Libro')->get() 
        ]);


        /**
         * 
         * Aquí se pretende extraer los datos del libro de internet através de una API... 
         * 
         */ 

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
            $CLASSES = Classification::orderBy('name')->where('type','Libro')->get();
            return view('books.create_new_book', compact('ISBN','TITLE','author','editorial','classes'));
        //} */
    }
}
