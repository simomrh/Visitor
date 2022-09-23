<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedTimes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlockedTimesController extends Controller
{
    public function allEvents()
    {

        $departements = DB::select('select * from wb_departement');
        $visiteurs = DB::select("select * from wb_visiteurs");
        return view('admin.BlockedTimes', compact('visiteurs', 'departements'));
    }

    public function apiEvents(Request $request)
    {
        if ($request->ajax()) {
            $events = BlockedTimes::all();
            return response()->json(["data" => $events]);
        } else {
            abort(404);
        }
    }

    public function storeEvents(Request $request)
    {
        $request->validate([
            'DateDeb' => "required",
            'DateFin' => "required",

        ]);


        $blocked_dates = new BlockedTimes();

        $blocked_dates->DateDeb = $request->input('DateDeb');
        $blocked_dates->DateFin = $request->input('DateFin');
        $blocked_dates->IdDEP = $request->input('IdDEP');

        $blocked_dates->UserCr = Auth::user()->LoginUSR;
        $blocked_dates->DateCr =  date("Y-m-d H:i:s");

        $blocked_dates->save();
        return response()->json(['message' => ' Temps Intervalle  est créé avec succès !'], 201);
    }
    public function UpdateEvents(Request $request, $IdBT)
    {

        $blocked_dates = BlockedTimes::find($IdBT);

        $blocked_dates->DateDeb = $request->input('DateDeb');
        $blocked_dates->DateFin = $request->input('DateFin');
        $blocked_dates->IdDEP = $request->input('IdDEP');
    
        $blocked_dates->UserUp = Auth::user()->LoginUSR;
        $blocked_dates->DateUp =  date("Y-m-d H:i:s");
        $blocked_dates->save();
        return response()->json(['message' => ' Temps Intervalle  est Modifié avec succès !'], 201);
    }

    public function DeleteBT($IdBT)
    {
        $blocked_dates = BlockedTimes::find($IdBT);
        $blocked_dates->delete();
        return response()->json(['message' => ' Temps Intervalle  est Supprimer !'], 201);
    }
}
