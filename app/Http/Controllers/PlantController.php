<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plant;
use App\Models\Classification;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para listar todas las plantas almacenadas en la base de datos
     * 
     * @return View con todas las plantas
     */
    public function index()
    {
        return view('plants.index_plants', [ 'plants' => Plant::all() ]);
    }

    /**
     * función para renderizar el formulario de creación de nuevas plantas
     * 
     * @return View con el formulario y la lista de clases del tipo de plantas que se pueden registrar
     */
    public function create()
    {
        return view('plants.create_plant', [ 'classes' => Classification::orderBy('name')->where('type', 'Planta')->get() ]);
    }

    /**
     * función para almacenar nuevas plantas en la base de datos
     * 
     * @param Request con la información de nuevas plantas a almacenar
     * @return Redirect hacía la vista de la lista de todas las plantas almacenadas con el mensaje de la operación de registro
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|min:5',
            'tips' => 'required',
            //'image' => 'required',//'mimes:jpeg,png',
            'stock' => 'required|integer|min:1',
            'classification_id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //$i = ($request->file('image')->store('public'));
        //$plant->image = $i;

        Plant::create($request->all());
        return redirect()->action([ PlantController::class, 'index'] )->with('success', 'La planta se ha registrado exitosamente!...');
    }

    /**
     * función para mostrar los detalles de las plantas 
     * 
     * @param Integer con el $id de la planta a mostrar
     * @return View con la vista de los detalles de la planta a mostrar
     */
    public function show($id)
    {
        return view('plants.show_plant', [ 'plant' => Plant::findOrFail($id) ] );
    }

    /**
     * función para renderizar la vista del formulario de edición de plantas 
     * 
     * @param Integer con el $id de la planta a editar
     * @return View con el formulario de edición, la información de la planta a editar y la información de las clases de platantas que se pueden modificar
     */
    public function edit($id)
    {
        return view('plants.edit_plant', [ 'plant' => Plant::findOrFail($id), 'classes' => Classification::orderBy('name')->where('type','Planta')->get() ]);
    }

    /**
     * función para actualizar la información de las plantas ya creadas en la base de datos
     * 
     * @param Request con la nueva información de la planta
     * @param Integer con el $id de la planta a modificar
     * @return Redirect hacía la vista de los detalles de la planta modificada y el mensaje de la operación de modificación
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|min:5',
            'tips' => 'required',
            //'image' => 'required', // mimes:jpeg,png
            'stock' => 'required|integer|min:1',
            'classification_id' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Plant::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ PlantController::class, 'show' ], $id)->with('edit','La planta se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar de la base de datos las plantas
     * 
     * @return Redirect hacía la lista de plantas con el mensaje de la operación
     */
    public function destroy($id)
    {
        Plant::findOrFail($id)->delete();
        return redirect()->action([ PlantController::class, 'index' ])->with('delete', 'La planta se ha eliminado correctamente!...');
    }
}
