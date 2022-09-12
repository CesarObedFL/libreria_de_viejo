<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Classification;

class ClassificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para listar las clasificaciones registradas en la base de datos
     * 
     * @return View con la lista de las clasificaciones
     */
    public function index()
    {
        return view('classifications.index_classes', [ 'classes' => Classification::all() ]);
    }

    /**
     * función para renderizar el formulario de creación de clasificaciones
     * 
     * @return View con el formulario de creación
     */
    public function create()
    {
        return view('classifications.create_class');
    }
    
    /**
     * función para almacenar las clasificaciones creadas desde el formulario en la base de datos
     * 
     * @param Request con la información de la clasificacion a guardar
     * @return Redirect hacia la lista de clasificaciones con el mensaje correspondiente
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::create($request->all());
        return redirect()->action([ ClassificationController::class, 'index' ])->with('success','La clase se ha registrado exitosamente!...');
    }

    public function edit($id)
    {
        return view('classifications.edit_class', [ 'class' => Classification::findOrFail($id) ]);
    }

    /**
     * función para actualizar la informacion de las clasificaciones registradas
     * 
     * @param Request con la nueva informacion de la clasificación
     * @param Integer con el $id de la clasificación a actualizar
     * @return Redirect hacia la lista de clasificaciones con el mensaje correspondiente
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ ClassificationController::class, 'index' ])->with('edit','La clase se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar las clasificaciones registradas en la base de datos
     * 
     * @return Redirect hacia la lista de clasificaciones registradas con el mensaje correspondiente
     */
    public function destroy($id)
    {
        Classification::findOrFail($id)->delete();
        return redirect()->action([ ClassificationController::class, 'index' ])->with('delete', 'La clase se ha eliminado exitosamente!...');
    }
}
