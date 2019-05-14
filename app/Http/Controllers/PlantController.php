<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Plant;
use App\Classification;

class PlantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $PLANTS = Plant::all();
        return view('plants.index_plants', compact('PLANTS'));
    }

    public function create()
    {
        $CLASSES = Classification::orderBy('class')->where('type',2)->get();
        return view('plants.create_plant', compact('CLASSES'));
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
        return redirect()->action('PlantController@index')->with('success', 'La planta se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $PLANT = Plant::findOrFail($id);
        return view('plants.info_plant', compact('PLANT'));
    }

    public function edit($id)
    {
        $CLASSES = Classification::orderBy('class')->where('type',2)->get();
        $PLANT = Plant::findOrFail($id);
        return view('plants.edit_plant', compact('PLANT','id','CLASSES'));
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
        return redirect()->action('PlantController@show',$id)->with('edit','La planta se ha modificador exitosamente!...');
    }

    public function destroy($id)
    {
        $PLANT = Plant::findOrFail($id)->delete();
        return redirect()->action('PlantController@index')->with('delete', 'La planta se ha eliminado correctamente!...');
    }
}
