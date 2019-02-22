<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $USERS = User::all();
        return view('users.index_users', compact('USERS'));
    }

    public function create()
    {
        return view('users.create_user');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|min:8',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } 

        User::create($request->all());
        return redirect()->action('UserController@index')->with('success','El usuario se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $USER = User::findOrFail($id);
        return view('users.info_user', compact('USER'));
    }

    public function edit($id)
    {
        $USER = User::findOrFail($id);
        return view('users.edit_user', compact('USER','id'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|min:8',
            //'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } 

        User::where('id', $id)->update($request->except('_token','_method'));
        return redirect()->action('UserController@show', $id)->with('edit', 'El usuario se ha modificado exitosamente!...');;
    }

    public function destroy($id)
    {
        $USER = User::findOrFail($id)->delete();
        return redirect()->action('UserController@index')->with('delete', 'El usuario se ha eliminado correctamente!...');
    }
}
