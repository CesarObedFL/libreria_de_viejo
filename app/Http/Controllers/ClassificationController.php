<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Classification;

class ClassificationController extends Controller
{
    public function index()
    {
        $CLASSES = Classification::all();
        return view('classifications.index_classes', compact('CLASSES'));
    }

    public function create()
    {
        return view('classifications.create_class');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required',
            //'location' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::create($request->all());
        return redirect()->action('ClassificationController@index')->with('success','La clase se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $CLASS = Classification::findOrFail($id);
        return view('classifications.info_class', compact('CLASS','id'));
    }

    public function edit($id)
    {
        $CLASS = Classification::findOrFail($id);
        return view('classifications.edit_class', compact('CLASS','id'));
    }

    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'class'     => 'required',
            'location' => 'required',
            //'type'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action('ClassificationController@show',$id)->with('edit','El cliente se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $CLASS = Classification::findOrFail($id)->delete();
        return redirect()->action('ClassificationController@index')->with('delete', 'La clase se ha eliminado exitosamente!...');
    }
}
