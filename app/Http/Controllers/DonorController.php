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

    public function index()
    {
        return view('donors.index_donors', [ 'DONORS' => Donor::all() ]);
    }

    public function create()
    {
        return view('donors.create_donor', [ 'CLASSES' => Classification::orderBy('class')->where('type', 'Libro')->get() ]);
    }

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
    
    public function edit($id)
    {
        return view('donors.edit_donor', [ 'DONOR' => Donor::findOrFail($id) ]);
    }

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

    public function destroy($id)
    {
        Donor::findOrFail($id)->delete();
        return redirect()->action([ DonorController::class, 'index' ])->with('delete','El contacto se ha eliminado exitosamente!...');
    }
}
