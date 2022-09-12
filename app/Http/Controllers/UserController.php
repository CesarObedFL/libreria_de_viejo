<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para listar a los usuarios registrados en la plataforma, solo puede ser usada por un usuario administrador
     * 
     * @return View con la lista de usuarios 
     */
    public function index()
    {
        if(Auth::user()->isAdmin()) {
            return view('users.index_users', [ 'users' => User::all() ]);
        }
        return view('home');
    }

    /**
     * función para renderizar la vista con el formulario de creación de nuevos usuarios, solo es empleado por usuarios administradores
     * 
     * @return View con el formulario de creación de nuevos usuarios
     */
    public function create()
    {
        if(Auth::user()->isAdmin()) {
            return view('users.create_user');
        }
        return view('home');
    }

    /**
     * función para almacenar nuevos usuarios en la base de datos
     * 
     * @param Request con la información de los nuevos usuarios
     * @return Redirect hacía la lista de usuarios con el resultado de la operación
     */
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

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'password' => bcrypt($request->get('password')),
            'role' => $request->get('role')
        ]);

        return redirect()->action([ UserController::class, 'index' ])->with('success', 'El usuario se ha registrado exitosamente!...');
    }

    /**
     * función para mostrar el perfil de los usuarios, cada usuario puede ingresar a su propio perfil o se da acceso a usuarios administradores
     * 
     * @param Integer con el $id del usuario
     */
    public function show($id)
    {
        if( Auth::user()->isAdmin() || Auth::id() == $id ) {
            return view('users.show_user', [ 'user' => User::findOrFail($id) ] );
        }
        return view('home');
    }

    /**
     * función para mostrar el formulario de edición de usuarios
     * 
     * @param Integer con el $id del usuario a editar
     * @return View del formulario con la información del usuario
     */
    public function edit($id)
    {
        return view('users.edit_user', [ 'user' => User::findOrFail($id) ] );
    }

    /**
     * función para actualizar la información de los usuarios
     * 
     * @param Request con la nueva información
     * @return Redirect hacía los detalles del usuario con el resultado de la operación
     */
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
        return redirect()->action([ UserController::class, 'show' ], $id)->with('edit', 'El usuario se ha modificado exitosamente!...');
    }

    /**
     * función para eliminar usuarios de la base de datos, solo puede ser usada por administradores
     * 
     * @param Integer con el $id del usuario a eliminar
     * @return Redirect hacía la lista de usuarios o hacía el perfil del usuario con el mensaje correspondiente
     */
    public function destroy($id)
    {
        if(Auth::user()->isAdmin()) {
            User::findOrFail($id)->delete();
            return redirect()->action([ UserController::class, 'index' ])->with('delete', 'El usuario se ha eliminado correctamente!...');
        } 
        return redirect()->action([ UserController::class, 'show' ], $id)->with('error', 'Se necesitan permisos de administrador!...');
    }

    /**
     * función para editar el rol de los usuarios, solo puede ser usada por administradores
     * 
     * @param Integer con el $id del usuario a cambiarle el rol
     * @return View con la vista del formulario de cambio de rol
     */
    public function showRole($id)
    {
        if(Auth::user()->isAdmin()) {
            return view('users.update_role_user', [ 'user' => User::findOrFail($id)]);
        } 
        return redirect()->action([ UserController::class, 'show' ], $id)->with('error', 'Se necesitan permisos de administrador...');

    }

    /**
     * función para actualizar el rol de los usuarios
     * 
     * @param Request con la información del nuevo rol
     * @param Integer con el $id del usuario a actualizar
     * @return Redirect hacía el perfil del usuario editado
     */
    public function updateRole(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        User::where('id', $id)->update($request->except('_token','_method'));
        return redirect()->action([ UserController::class, 'show' ], $id)->with('edit', 'El rol del usuario se ha modificado exitosamente!...');
    }

    /**
     * función para mostrar el formulario de edición de contraseña de usuarios, solo puede ser usada por el propio usuario o por administradores
     * 
     * @param Integer con el $id del usuario al que se le modificará la contraseña
     * @return View hacía el formulario si se tienen los permisos
     */
    public function showPass($id)
    {
        if(Auth::user()->isAdmin() || Auth::id() == $id) {
            return view('users.change_pass', [ 'user' =>  User::findOrFail($id) ]);
        }
        return redirect()->action([ UserController::class, 'show' ], $id)->with('error', 'Ocurrio un error... ID de usuario incorrecto...');
    }

    /**
     * función para actualizar la contraseña de los usuarios
     * 
     * @param Request con la nueva contraseña a registrar
     * @param Integer con el $id del usuario a modificar
     * @return Redirect hacía los detalles del usuario modificado
     */
    public function updatePass(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect()->action([ UserController::class, 'show' ], $id)->with('edit', 'La contraseña de usuario se ha modificado exitosamente!...');
    }
}
