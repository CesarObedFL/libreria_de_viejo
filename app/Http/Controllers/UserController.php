<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $USERS = User::all();
        return view('users.index_users',compact('USERS'));
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
            'phone' => 'required|numeric|min:100000000|max:9999999999',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $USER = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => bcrypt($request->get('password')),
            'role' => $request->get('role')
        ]);
        $USER->save();

        return redirect()->action('UserController@index')->with('success','El usuario se ha registrado exitosamente!...');
    }

    public function show($ID)
    {
        $USER = User::findOrFail($ID);
        return view('users.info_user', compact('USER'));
    }

    public function edit($ID)
    {
        $USER = User::findOrFail($ID);
        return view('users.edit_user', compact('USER','ID'));
    }

    public function update(Request $request, $ID)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|min:8',
            //'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } 

        User::where('ID', $ID)->update($request->except('_token','_method'));
        return redirect()->action('UserController@show', $ID)->with('edit','El usuario se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $USER = User::findOrFail($ID)->delete();
        return redirect()->action('UserController@index')->with('delete','El usuario se ha eliminado correctamente!...');
    }

    public function perfil() 
    {
        $USER = User::findOrFail(Auth::id());
        return view('users.perfil_user',compact('USER'));
    }

    public function showRole($ID)
    {
        $USER = User::findOrFail($ID);
        return view('users.update_role_user',compact('USER'));
    }

    public function updateRole(Request $request, $ID)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } 

        User::where('ID', $ID)->update($request->except('_token','_method'));
        return redirect()->action('UserController@show', $ID)->with('edit','El rol del usuario se ha modificado exitosamente!...');
    }
}
