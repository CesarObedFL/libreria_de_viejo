<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Bartering;

class BarteringController extends Controller
{
    public function index()
    {
        $BARTERINGS = Bartering::all();
        return view('barterings.index_barterings', compact('BARTERINGS'));
    }

    public function create()
    {
        return view('barterings.create_bartering');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // BOOK TABLE
            'ISBN' => 'required',
            'amount' => 'required|min:1',
            //'register' => 'required_if:type,empresa' // requerido si el tipo es un determinado
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Bartering::create($request->all());
        return redirect()->action('BarteringController@index')->with('success', 'El trueque se ha registrado exitosamente!...');
    }

    public function show($id)
    {
        $BARTERING = Bartering::findOrFail($id);
        return view('bartering.info_bartering', compact('BARTERING'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $BARTERING = Bartering::findOrFail($id);
        $BARTERING->delete();
        return redirect()->action('BarteringController@index')->with('delete', 'El trueque se ha eliminado exitosamente!...');
    }
}
