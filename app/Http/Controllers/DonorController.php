<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Classification;

class DonorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para renderizar la lista de donadores
     * 
     * @return View con la lista de todos los donadores registrados en la plataforma
     */
    public function index()
    {
        return view('donors.index_donors', [ 'donors' => Donor::all() ]);
    }

    /**
     * función para renderizar la vista del formulario de creación de donadores
     * 
     * @return View del formulario de creación
     */
    public function create()
    {
        return view('donors.create_donor');
    }

    /**
     * función para almacenar la información de nuevos donadores registrados
     * 
     * @param Request con la información de los nuevos donadores
     * @return Redirect hacía la lista de todos los donadores creados junto con el mensaje correspondiente
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'contact' => 'required|max:50'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        Donor::create($request->all());
        return redirect()->action([ DonorController::class, 'index' ])->with('success','El contacto se registro correctamente...');
    }

    /**
     * función para renderizar la vista del formulario de edición de donadores
     * 
     * @param Integer con el $id del donador a modificar
     * @return View con el formulario de edición con la información del donador a modificar
     */
    public function edit($id)
    {
        return view('donors.edit_donor', [ 'donor' => Donor::findOrFail($id) ]);
    }

    /**
     * función para actualizar la información de los donadores almacenados
     * 
     * @param Request con la nueva información del donador
     * @param Integer con el $id del donador a modificar
     * @return View hacía la lista de los donadores con el mensaje de la operación
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required|max:50'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        Donor::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ DonorController::class, 'index' ])->with('edit','El contacto se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar donadores 
     * 
     * @param Integer con el $id del donador a eliminar
     * @return Redirect hacía la lista de los donadores con el mensaje de la operación
     */
    public function destroy($id)
    {
        Donor::findOrFail($id)->delete();
        return redirect()->action([ DonorController::class, 'index' ])->with('delete','El contacto se ha eliminado exitosamente!...');
    }
}
