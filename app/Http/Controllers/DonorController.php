<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Donor;
use App\Classification;

class DonorController extends Controller
{

    public function index()
    {
        $DONORS = Donor::all();
        return view('donors.index_donors',compact('DONORS'));
    }

    public function create()
    {
        $CLASSES = Classification::orderBy('class')->where('type',1)->get();
        return view('donors.create_donor',compact('CLASSES'));
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
        return redirect()->action('DonorController@index')->with('success','El contacto se registro correctamente...');
    }

    public function show($ID)
    {
        //
    }
    
    public function edit($ID)
    {
        $DONOR = Donor::findOrFail($ID);
        return view('donors.edit_donor',compact('DONOR'));
    }

    public function update(Request $request, $ID)
    {
        $validator = Validator::make($request->all(), [
            'contact' => 'required|max:50'
        ]);

        if($validator->fails())
            return redirect()->back()->withErrors($validator->errors())->withInput();

        Donor::where('ID',$ID)->update($request->except('_token','_method'));
        return redirect()->action('DonorController@index')->with('edit','El contacto se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $DONOR = Donor::findOrFail($ID);
        $DONOR->delete();
        return redirect()->action('DonorController@index')->with('delete','El contacto se ha eliminado exitosamente!...');
    }
}
