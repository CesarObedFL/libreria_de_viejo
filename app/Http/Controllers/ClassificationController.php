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
        //$CLASSES = DB::table('classifications')->paginate(10);
        //return view('classifications.index_classes', ['CLASSES' => $CLASSES]);
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
            'location' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::create($request->all());
        return redirect()->action('ClassificationController@index')->with('success','La clase se ha registrado exitosamente!...');
    }

    public function show($ID)
    {
        $CLASS = Classification::findOrFail($ID);
        return view('classifications.info_class', compact('CLASS','ID'));
    }

    public function edit($ID)
    {
        $CLASS = Classification::findOrFail($ID);
        return view('classifications.edit_class', compact('CLASS','ID'));
    }

    public function update(Request $request, $ID)
    {
        
        $validator = Validator::make($request->all(), [
            'class'     => 'required',
            'location' => 'required',
            //'type'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::where('ID',$ID)->update($request->except('_token','_method'));
        return redirect()->action('ClassificationController@show',$ID)->with('edit','El cliente se ha modificado exitosamente!...');
    }

    public function destroy($ID)
    {
        $CLASS = Classification::findOrFail($ID)->delete();
        return redirect()->action('ClassificationController@index')->with('delete', 'La clase se ha eliminado exitosamente!...');
    }
}
