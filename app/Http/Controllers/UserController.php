<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin()) {
            $USERS = User::all();
            return view('users.index_users',compact('USERS'));
        }
        return redirect()->action('HomeController@index');
    }

    public function create()
    {
        if(Auth::user()->isAdmin()) {
            return view('users.create_user');
        }
        return redirect()->action('HomeController@index');
        
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|max:20',
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

    public function show($id)
    {
        if(Auth::user()->isAdmin()) {
            $USER = User::findOrFail($id);
            return view('users.info_user', compact('USER'));
        } else if(Auth::id() == $id) {
            $USER = User::findOrFail($id);
            return view('users.info_user', compact('USER'));
        }
        return redirect()->action('HomeController@index');
    }

    public function edit($id)
    {
        $USER = User::findOrFail($id);
        return view('users.edit_user', compact('USER','id'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|numeric|digits:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        User::where('id', $id)->update($request->except('_token','_method'));
        return redirect()->action('UserController@show', $id)->with('edit','El usuario se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        if(Auth::user()->isAdmin()) {
            User::findOrFail($id)->delete();
            return redirect()->action('UserController@index')->with('delete','El usuario se ha correctamente!...');
        } 
        return redirect()->action('UserController@show',$id)->with('delete','Se necesitan permisos de administrador...');
    }

    public function showRole($id)
    {
        if(Auth::user()->isAdmin()) {
            $USER = User::findOrFail($id);
            return view('users.update_role_user',compact('USER'));
        } 
        return redirect()->action('UserController@show',$id)->with('delete','Se necesitan permisos de administrador...');

    }

    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        User::where('id', $id)->update($request->except('_token','_method'));
        return redirect()->action('UserController@show', $id)->with('edit','El rol del usuario se ha modificado exitosamente!...');
    }

    public function showPass($id)
    {
        if(Auth::user()->isAdmin()) {
            $USER = User::findOrFail($id);
            return view('users.change_pass',compact('USER'));
        } else if(Auth::id() == $id) {
            $USER = User::findOrFail($id);
            return view('users.change_pass',compact('USER'));
        }
        return redirect()->action('UserController@show',$id)->with('delete','Ocurrio un error... ID de usuario incorrecto...');
    }

    public function updatePass(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $USER = User::findOrFail($id);
        $USER->password = bcrypt($request->get('password'));
        $USER->save();

        return redirect()->action('UserController@show', $id)->with('edit','La contraseña de usuario se ha modificado exitosamente!...');
    }
}
