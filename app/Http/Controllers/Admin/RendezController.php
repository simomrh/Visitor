<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedTimes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
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
        return view('admin.rendezVous', compact('users', 'departements', 'visiteurs', 'typesVisite'));
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
    public function getDetails(Request $request, $IdVS)
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
    public function Dropdown(Request $request, $IdDEP)
    {

        $username = DB::table('wb_users')->select('LoginUSR')->where('IdDEP', $IdDEP)->get();
        return json_encode($username);
    }
    public function storeRendezVous(Request $request)
    {

        $request->validate([
            'NomVS' => "required",
            'CINVS' => "required",
            'EmailVS' => "required|email",
            'SocieteVS' => "nullable",
            'IdTP' => "required",
            'DateRD' => "required|date",

        ]);

        $date_rdv = \DateTime::createFromFormat("Y-m-d\TH:i", $request->input("DateRD"))->format('Y-m-d H:i:s');

        $blocked_dates = DB::select("select IdBT, DateDeb, DateFin from wb_blocked_time where ? BETWEEN SUBTIME(DateDeb, '00:30:00') AND ADDTIME(DateFin, '00:05:00') ", [$date_rdv]);


        if (!empty($blocked_dates)) {

            return response()->json(["error" => Carbon::createFromFormat("Y-m-d\TH:i", $request->input("DateRD"))->format('d/m/Y H:i') . " : n'est pas disponible, choisissez une autre date"], 208);
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

        $rendezVous->DateRD  = $request->input('DateRD');
        $rendezVous->UserCr = Auth::user()->LoginUSR;
        $rendezVous->DateCr =  date("Y-m-d H:i:s");
        $rendezVous->save();


        /*$IdVS  = Visiteur::all()->last()->IdVS;
        $IdRD = RendezVous::all()->last()->IdRD;

        $visite = new Visite();
        $visite->IdVS = $IdVS;
        $visite->IdRD = $IdRD;
        $visite->IdDEP = $request->input('IdDEP');
        $visite->idUSR = $request->input('idUSR');
        $visite->RaisonVis = $request->input('RaisonVis');
        $visite->UserCr = Auth::user()->LoginUSR;
        $visite->DateCr =  date("Y-m-d H:i:s");
        $visite->save();*/



        return response()->json(['success' => 'Rendez-vous est créé avec succès !'], 201);
    }

    public function UpdateRendezVous(Request $request, $IdRD)
    {

        $rendezVous = RendezVous::find($IdRD);

        $rendezVous->DateRDV = $request->input('DateRD');
        $rendezVous->UserUp = Auth::user()->LoginUSR;
        $rendezVous->DateUp =  date("Y-m-d H:i:s");
        $rendezVous->save();

        return response()->json(['message' => 'Rendez-vous est Modifié avec succès !'], 201);
    }

    public function validerRDV(Request $request ,  $IdRD )
    {


        $rendezVous = RendezVous::find($IdRD);

        $date_rdv =   DB::table('wb_rendezvous')
            ->select('DateRD')
            ->where('IdRD' , $IdRD)
            ->get();
           /* $username = DB::table('wb_users')->select('LoginUSR')->where('IdDEP', $IdDEP)->get();
            $date_rdv = Visite::select('wb_visites.*', 'wb_rendezvous.DateRD')
            ->join('wb_rendezvous', 'wb_visites.IdRD', '=', 'wb_rendezvous.IdRD')
            ->get();*/


        $date = $date_rdv->first()->DateRD;

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  $date)->format("d/m/Y H:i:s");

        $username =   DB::table('wb_rendezvous')
        ->select('UserCr')
        ->where('IdRD' , $IdRD)
        ->get();
        $host = $username->first()->UserCr;

        $id_rdv =   DB::table('wb_rendezvous')
        ->select('IdRD')
        ->where('IdRD' , $IdRD)
        ->get();

        $id = $id_rdv->first()->IdRD;

        if (Auth::user()->ValideRD === 0) {
            return response()->json(['error' => " vous n'avez pas la permission !"], 208);
        } else {

            $rendezVous->Valide  = $request->input("Valide") ? 1 : 0;
            $rendezVous->Annule  = "0" ;
            $rendezVous->save();

            $details = [

                'title' => 'Email de Visitor',

                'body' => 'vous êtes invité par '  .$host.  ' le ' .$date.  ' dans la societé XXX',

                'id' => '' .$id. '',

            ];

            Mail::to('simomar.testing@gmail.com')->send(new \App\Mail\email($details));

            return response()->json(['success' => ' Rendez-vous  est Validé avec succès !'], 201);
        }
    }
    public function blockRD(Request $request , $IdRD)
    {
        $rendezVous = RendezVous::find($IdRD);
        if (Auth::user()->RoleUSR  === "user") {
            return response()->json(['error' => " vous n'avez pas la permission !"], 208);
        } else {
            $rendezVous->Annule   = $request->input("Annule") ? 1 : 0;
            $rendezVous->Valide  = "0" ;
            $rendezVous->save();
            return response()->json(['success' => "  Rendez-vous est bloqué !"], 201);
        }
    }
    public function ConfirmRdv($IdRD){

    /*$rendezVous = RendezVous::find($IdRD);

    $rendezVous->ConfirmerRD  = "1";
    $rendezVous->save();*/
   return view('emails.confirmerEmail');

   }
    public function rendezExport(Request $request)
    {

        $rendezVouss = RendezVous::get();

        // these are the headers for the csv file.
        $headers = array(
            'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder.
        if (!File::exists(public_path() . "/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/rendez-vous.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, ['Id rendezVous', ' Date Rendez vous'], ';');

        //adding the data from the array
        foreach ($rendezVouss as $each_rendezVous) {
            fputcsv($handle, [
                $each_rendezVous->IdRD,
                $each_rendezVous->DateRD,
                $each_rendezVous->ConfirmerRD,
                $each_rendezVous->AnnulerRD,
            ], ";");
        }
        fclose($handle);

        //download command
        return Response::download($filename, "rendez-vous.csv", $headers);
    }


    public function deleteRD($IdRD)
    {
        $rendezVous = RendezVous::find($IdRD);
        $rendezVous->delete();
        return response()->json(["success" => "rendez-vous  est Supprimer"], 201);
    }
    /*public function ConfirmerRDV(Request $request)
    {
        return view('emails.confirmerEmail');
    }*/
    public function refuserRDV(Request $request)
    {
        return view('emails.annulerEmail');
    }

    /*public function rdvConfirm(Request $request , $IdRD)
    {
           $rendezVous = RendezVous::find($IdRD);
            $rendezVous->ConfirmerRD  = $request->input("ConfirmerRD") ? 1 : 0;
            $rendezVous->save();
            return response()->json(["success" => "rendez-vous  est Confirmer"], 201);


    }*/
}
