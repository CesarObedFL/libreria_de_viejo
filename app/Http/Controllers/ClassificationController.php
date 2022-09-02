<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Classification;

class ClassificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('classifications.index_classes', [ 'CLASSES' => Classification::all() ]);
    }

    public function create()
    {
        return view('classifications.create_class');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::create($request->all());
        return redirect()->action([ ClassificationController::class, 'index' ])->with('success','La clase se ha registrado exitosamente!...');
    }

    public function edit($id)
    {
        return view('classifications.edit_class', [ 'CLASS' => Classification::findOrFail($id) ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'class'     => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Classification::where('id',$id)->update($request->except('_token','_method'));
        return redirect()->action([ ClassificationController::class, 'index' ])->with('edit','La clase se ha modificado exitosamente!...');
    }

    public function destroy($id)
    {
        $CLASS = Classification::findOrFail($id)->delete();
        return redirect()->action([ ClassificationController::class, 'index' ])->with('delete', 'La clase se ha eliminado exitosamente!...');
    }
}
