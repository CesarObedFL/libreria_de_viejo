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
            'email' => 'required|unique:clients',
            'phone' => 'required|min:8',
            'interests' => 'required',
            'type' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Client::create($request->all());
        return redirect()->action('ClientController@index')->with('success', 'El cliente se ha registrado exitosamente!...');
    }

    public function show($ID)
    {
        $CLIENT = Client::find($ID);
        return view('clients.info_client', compact('CLIENT'));
    }

    public function edit($ID)
    {
        $CLIENT = Client::findOrFail($ID);
        return view('clients.edit_client', compact('CLIENT'));
    }

    public function update(Request $request, $ID)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients',
            'phone' => 'required|min:8',
            'type' => 'required',
            'interests' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Client::where('ID',$ID)->update($request->except('_token','_method'));
        return redirect()->action('ClientController@show',$ID)->with('edit','El cliente se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $CLIENT = Client::findOrFail($ID)->delete();
        return redirect()->action('ClientController@index')->with('delete', 'El cliente se ha eliminado exitosamente!...');
    }
}
