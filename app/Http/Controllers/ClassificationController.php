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

    public function show($id)
    {
        $CLASS = Classification::find($id);
        return view('classifications.info_class', compact('CLASS','id'));
    }

    public function edit($id)
    {
        $CLASS = Classification::find($id);
        return view('classifications.edit_class')->with(['CLASS' => $CLASS]);
    }

    public function update(Request $request, $id)
    {
        //Classification::where('id', $id)->update($request->except('_token','_method'));
        //return redirect()->action('ClassificationController@show', $id);
        $validator = Validator::make($request->all(), [
            'class'     => 'required',
            'location' => 'required',
            'type'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();

        } else {
            $CLASS = Classification::find($id);
            $CLASS->class = $request->get('class');
            $CLASS->location = $request->get('location');
            $CLASS->type = $request->get('type');
            $CLASS->update();
            return view('classifications.info_class')->with(['CLASS' => $CLASS]);
        }
    }

    public function destroy($id)
    {
        $CLASS = Classification::find($id);
        $CLASS->delete();
        return redirect()->action('ClassificationController@index')->with('delete', 'La clase se ha eliminado exitosamente!...');
    }
}
