<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedTimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\RaisonVisite;

use App\Models\RendezVous;
use App\Models\Visite;
use App\Models\Visiteur;
use Illuminate\Support\Carbon;

class RendezController extends Controller
{
    public function index()
    {
        $departements = DB::select('select * from wb_departement');
        $users = DB::select("select * from wb_users ");
        $visiteurs = DB::select("select * from wb_visiteurs");
        $typesVisite = DB::select("select * from wb_type_visite");
        return view('admin.rendezVous', compact('users', 'departements', 'visiteurs' , 'typesVisite'));
    }

    public function allRendezVous(Request $request)
    {
        if ($request->ajax()) {
            $rendezVous = RendezVous::all();
            return response()->json(["data" => $rendezVous]);
        } else {
            abort(404);
        }
    }
    public function getDetails(Request $request , $IdVS)
    {
        if ($request->ajax()) {
        $data = DB::table('wb_visiteurs')->where('IdVS', $IdVS)->first();
         return response()->json([
         'NomVS' => $data->NomVS,
         'CINVS' => $data->CINVS,
         'GSMVS' => $data->GSMVS,
         'EmailVS' => $data->EmailVS,
         'SocieteVS' => $data->SocieteVS,
          ]);
        } else {
            abort(404);
        }
    }
    public function Dropdown(Request $request , $IdDEP)
    {
        if ($request->ajax()) {
        $username['data'] = DB::table('wb_users')->select('LoginUSR')->where('IdDEP', $IdDEP)->get();
         return response()->json( $username );
        } else {
            abort(404);
        }
    }
    public function storeRendezVous(Request $request)
    {

        $request->validate([
            'NomVS' => "required",
            'CINVS' => "required",
            'EmailVS' => "required|email",
            'IdDEP'  => "required",
            'idUSR'  => "required",
            'SocieteVS' => "nullable",
            'RaisonVis' => "required",
            'IdTP' => "required",
            'DateRDV' => "required|date",

        ]);

        $date_rdv = \DateTime::createFromFormat("Y-m-d\TH:i", $request->input("DateRDV"))->format('Y-m-d H:i:s');

        $blocked_dates = DB::select("select IdBT, DateDeb, DateFin from wb_blocked_time where ? BETWEEN SUBTIME(DateDeb, '00:30:00') AND ADDTIME(DateFin, '00:05:00') ", [$date_rdv]);


        if (!empty($blocked_dates)) {

            return response()->json(["error" => Carbon::createFromFormat("Y-m-d\TH:i",$request->input("DateRDV"))->format('d/m/Y H:i') . " : n'est pas disponible, choisissez une autre date"], 208);
        }

        /*$blocked_times = BlockedTimes::where(['DateDeb' => $request->input("DateDeb")])
        ->Where(['DateFin' => $request->input("DateFin")])->first();

        if (!empty($blocked_times)) {
            return response()->json(["error" => "the date is blocked choose another Date"], 208);
        }*/






        $visiteur = new Visiteur();
        $visiteur->NomVS = $request->input('NomVS');
        $visiteur->CINVS = $request->input('CINVS');
        $visiteur->GSMVS = $request->input('GSMVS');
        $visiteur->EmailVS = $request->input('EmailVS');
        $visiteur->IdTP = $request->input('IdTP');
        $visiteur->SocieteVS = $request->input('SocieteVS');
        $visiteur->UserCr = Auth::user()->LoginUSR;
        $visiteur->DateCr  =  date("Y-m-d H:i:s");
        $visiteur->save();



        $rendezVous = new RendezVous();

        $rendezVous->DateRDV = $request->input('DateRDV');
        $rendezVous->UserCr = Auth::user()->LoginUSR;
        $rendezVous->DateCr =  date("Y-m-d H:i:s");
        $rendezVous->save();


        $IdVS  = Visiteur::all()->last()->IdVS;
        $IdRD = RendezVous::all()->last()->IdRD;

        $visite = new Visite();
        $visite->IdVS = $IdVS;
        $visite->IdRD = $IdRD;
        $visite->IdDEP = $request->input('IdDEP');
        $visite->idUSR = $request->input('idUSR');
        $visite->RaisonVis = $request->input('RaisonVis');
        $visite->UserCr = Auth::user()->LoginUSR;
        $visite->DateCr =  date("Y-m-d H:i:s");
        $visite->save();

        return response()->json(['success' => 'Rendez-vous est créé avec succès !'], 201);
    }

    public function UpdateRendezVous(Request $request, $IdRD)
    {

        $rendezVous = RendezVous::find($IdRD);



        $rendezVous->DateRDV = $request->input('DateRDV');

        $rendezVous->UserUp = Auth::user()->LoginUSR;
        $rendezVous->DateUp =  date("Y-m-d H:i:s");
        $rendezVous->save();

        return response()->json(['message' => 'Rendez-vous est Modifié avec succès !'], 201);
    }
}
