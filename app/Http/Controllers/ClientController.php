<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    public function index()
    {
        $CLIENTS = Client::all();
        return view('clients.index_clients',compact('CLIENTS'));
    }

    public function create()
    {
        return view('clients.create_client');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'interests' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Client::create($request->all());
        return redirect()->action('ClientController@index')->with('success', 'El cliente se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $CLIENT = Client::find($id);
        return view('clients.info_client', compact('CLIENT'));
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
        $CLIENT = Client::findOrFail($id);
        $CLIENT->delete();
        return redirect()->action('ClientController@index')->with('delete', 'El cliente se ha eliminado exitosamente!...');
    }
}
