<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Plant;
use App\Models\Classification;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('plants.index_plants', [ 'PLANTS' => Plant::all() ]);
    }

    public function create()
    {
        return view('plants.create_plant', [ 'CLASSES' => Classification::orderBy('class')->where('type', 'Planta')->get() ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|min:5',
            'tips' => 'required',
            //'image' => 'required',//'mimes:jpeg,png',
            'stock' => 'required|integer|min:1',
            'classification' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //$i = ($request->file('image')->store('public'));
        //$plant->image = $i;

        Plant::create($request->all());
        return redirect()->action([ PlantController::class, 'index'] )->with('success', 'La planta se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        return view('plants.show_plant', ['PLANT' => Plant::findOrFail($id) ] );
    }

    public function edit($id)
    {
        return view('plants.edit_plant', [ 'PLANT' => Plant::findOrFail($id), 'CLASSES' => Classification::orderBy('class')->where('type','Planta')->get() ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|min:5',
            'tips' => 'required',
            //'image' => 'required', // mimes:jpeg,png
            'stock' => 'required|integer|min:1',
            'classification' => 'required',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Plant::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ PlantController::class, 'show' ], $id)->with('edit','La planta se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $PLANT = Plant::findOrFail($id)->delete();
        return redirect()->action([ PlantController::class, 'index' ])->with('delete', 'La planta se ha eliminado correctamente!...');
    }
}
