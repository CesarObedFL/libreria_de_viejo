<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){}
    public function create(){}
    public function store(Request $request){}
    public function show($id){}
    public function edit($id){}
    public function update(Request $request, $id){}
    public function destroy($id){}

    public function cut()
    {
        return view('admin.cut.cut_index');
    }

    public function pay()
    {
        
    }

    public function barcodes()
    {
        return view('admin.barcodes.barcodes_index');
    }
}
