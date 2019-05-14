<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return redirect()->action('ClientController@index')->with('success', 'El cliente se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $CLIENT = Client::find($id);
        return view('clients.info_client', compact('CLIENT'));
    }

    public function edit($id)
    {
        $CLIENT = Client::findOrFail($id);
        return view('clients.edit_client', compact('CLIENT'));
    }

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
        return redirect()->action('ClientController@show',$id)->with('edit','El cliente se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $CLIENT = Client::findOrFail($id)->delete();
        return redirect()->action('ClientController@index')->with('delete', 'El cliente se ha eliminado exitosamente!...');
    }
}
