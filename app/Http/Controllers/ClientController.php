<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para listar a los clientes registrados en la plataforma
     * 
     * @return View con todos los clientes registrados
     */
    public function index()
    {
        return view('clients.index_clients', [ 'clients' => Client::all() ]);
    }

    /**
     * función para renderizar la vista para crear clientes nuevos
     * 
     * @return View del formulario de creación de nuevos clientes
     */
    public function create()
    {
        return view('clients.create_client');
    }

    /**
     * función para almacenar en la base de datos los nuevos clientes creados, solo los usuarios del sistema son capaces de crear a los clientes
     * 
     * @param Request con la información del cliente creado
     * @return Redirect hacia la lista de clietnes creados
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            //'email' => 'required|unique:clients',
            //'phone' => 'required|digits:10',
            //'interests' => 'required|max:50',
            'type' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Client::create($request->all());
        return redirect()->action([ ClientController::class, 'index' ])->with('success', 'El cliente se ha registrado exitosamente!...');
    }

    /**
     * función para mostrar el detalle de los clientes registrados en la plataforma
     * 
     * @param Integer con el $id del cliente a mostrar
     * @return View con la información del cliente alcanzado
     */
    public function show($id)
    {
        return view('clients.show_client', [ 'client' => Client::findOrFail($id) ]);
    }

    /**
     * función para renderizar el formulario de edición de clientes registrados
     * 
     * @param Integer con el $id del cliente a modificar
     * @return View con el formulario de edición y la información del cliente a modificar
     */
    public function edit($id)
    {
        return view('clients.edit_client', [ 'client' => Client::findOrFail($id) ]);
    }

    /**
     * función para actualizar la información de los clientes registrados en la base de datos
     * 
     * @param Request con la nueva información del cliente a modificar
     * @param Integer con el $id del cliente a actualizar
     * @return Redirect hacia el detalle del cliente modificado con el mensaje correspondiente
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|unique:clients,email,'.$id,
            'phone' => 'required|size:10',
            'type' => 'required',
            'interests' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Client::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ ClientController::class, 'show' ], $id)->with('edit', 'El cliente se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar a los clientes registrados en la base de datos
     * 
     * @param Integer con el $id del cliente a eliminar
     * @return Redirect hacia la lista de los clientes registrados y con la información de la operación
     */
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect()->action([ ClientController::class, 'index' ])->with('delete', 'El cliente se ha eliminado exitosamente!...');
    }
}
