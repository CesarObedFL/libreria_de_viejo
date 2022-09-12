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

    /**
     * función que renderiza la vista de la creación de nuevas caracterizticas de los libros ya creados en la base de datos
     * 
     * @param Integer con el $id del libro al que se le añade una nueva característica
     */
    public function newFeature($book_id)
    {
        return view('features.create_feature', [ 'book_id' => Book::findOrFail($book_id)->id ]);
    }

    /**
     * función para almacenar en la base de datos la información de las nuevas caracteristicas de los libros ya almacenados en la base de datos
     * 
     * @param Request con la información de las nuevas caracteristicas
     * @return View hacía la vista de los detalles del libro al que se le añadió las caracteristicas creadas
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edition' => 'required|max:20',
            'stock' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:5|max:99999',
            'conditions' => 'required|max:20',
            'place' => 'required|min:0|max:13',
            'location' => 'required|numeric|min:0|max:13',
            'language' => 'required|max:20'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        Feature::create($request->all());
        return view('books.show_book', [ 'book' => Book::findOrFail($request->book_id) ])->with('success', 'La entrada del libro se ha creado exitosamente!...');
    }

    /**
     * función para renderizar el formulario de edición de características de libros
     * 
     * @param Integer con el $id de la característica a editar
     * @return View del formulario de edición y la información de la característica a modificar
     */
    public function edit($id)
    {
        return view('features.edit_feature', [ 'feature' => Feature::findOrFail($id) ]);
    }

    /**
     * función para actualizar caracteristicas de libros ya guardadas en la base de datos
     * 
     * @param Request con la nueva informmación de la característica
     * @param Integer con el $id de la característica 
     * @return Redirect hacía la vista de los detalles del libro al que le pertenece la característica modificada
     */
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
        
        $book_id = Feature::where('id',$id)->update($request->except('_token','_method'));
        //$book_id = Feature::findOrFail($id)->book_id;
        return redirect()->action([ BookController::class, 'show' ], $book_id)->with('edit', 'La entrada del libro se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar las caracteristicas
     * 
     * @param Integer con el $id de la característica a eliminar
     * @return Redirect hacía los detalles del libro con el mensaje de la operación correspondiente
     */
    public function destroy($id)
    {
        Feature::findOrFail($id)->delete();
        return redirect()->back()->with('delete', 'La entrada del libro se ha eliminado exitosamente!...');
    }
}
