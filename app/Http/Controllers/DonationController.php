<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Classification;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * función para listar las donaciones de libros hechas y recibidas
     * cuanta con un filtro de fechas
     * 
     * @param Request con el filtro de fechas aplicado
     * @return View con la información de las donaciones filtradas y las fechas aplicadas
     */
    public function index(Request $request)
    {
        $start_date = '2019-05-14';
        $end_date = Carbon::now()->toDateString();

        $donations = Donation::all();

        if(!is_null($request->start_date) && !empty($request->start_date) &&
            !is_null($request->end_date) && !empty($request->end_date)) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $donations = Donation::whereBetween('date',[$start_date, $end_date])->get();
        }
            
        return view('donations.index_donations', [ 'donations' => $donations, 'start_date' => $start_date, 'end_date' => $end_date ]);
    }

    /**
     * función para almacenar la información de las donaciones hechas y recibidas
     * 
     * @param Request con la información a almacenar
     * @return Redirect hacia la lista de las donaciones con la información de la donación
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'donor_id' => 'required',
            'amount' => 'required|integer|min:1',
            'classification_id' => 'required',
            'type' => 'required|integer|min:1|max:2',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Donation::create([
            'donor_id' => $request->get('donor_id'),
            'type' => $request->get('type'),
            'amount' => $request->get('amount'),
            'date' => Carbon::now()->toDateString(),
            'user_id' => Auth::id(),
            'classification_id' => $request->get('classification_id')
        ]);

        return redirect()->action([ DonationController::class, 'index' ])->with('success', 'La donación se realizó exitosamente!...');
    }

    /**
     * función para mostrar los detalles de las donaciones
     * 
     * @param Integer con el $id de la donación a detallar
     * @return View con la información de la donación
     */
    public function show($id)
    {
        return view('donations.show_donation', [ 'donation' => Donation::findOrFail($id) ]);
    }

    /**
     * función para elimninar las donaciones de la base de datos
     * 
     * @param Integer con el $id de la donación a eliminar
     * @return Redirect hacia la vista de la lista de las donaciones con el mensaje correspondiente
     */
    public function destroy($id)
    {
        Donation::findOrFail($id)->delete();
        return redirect()->action([ DonationController::class, 'index' ])->with('delete', 'La donación se elimino exitosamente!...');
    }

    /**
     * función para renderizar la vista de recibir donaciones con los parametros necesarios
     * 
     * @return View con el formulario de recibir donaciones y la información necesaria para ello
     */
    public function receive()
    {
        return view('donations.create_donation', [ 'title' => "Recibir Donación", 'type' => 1, 'donors' => Donor::all(), 'classes' => Classification::orderBy('name')->where('type', 'Libro')->get() ]);
    }

    /**
     * función para renderizar la vista de realizar donaciones con los paramentros necesarios
     * 
     * @return View con el formulario de realizar donaciones con la infromación necesaria para ello
     */
    public function donate()
    {
        return view('donations.create_donation', [ 'title' => "Realizar Donación", 'type' => 2, 'donors' => Donor::all(), 'classes' => Classification::orderBy('name')->where('type', 'Libro')->get() ]);
    }
}
