<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Visite;
use App\Models\RendezVous;
use App\Exports\VisitesExport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
class VisiteController extends Controller
{
    public function visitesView()
    {
        $visites = DB::select('select * from  wb_visites');
        return view('admin.visites', compact('visites'));
    }

    public function allVisites(Request $request)
    {
        if ($request->ajax()) {
            $visite = Visite::all();
            return response()->json(["data" => $visite]);
        } else {
            abort(404);
        }
    }

    public function updateVisite(Request $request, $IdVis)
    {

        $visite = Visite::find($IdVis);

        $visite->Check_In = $request->input("Check_In");
        $visite->Check_Out  = $request->input("Check_Out");
        $visite->RaisonVis  = $request->input("RaisonVis");
        $visite->Annule  = $request->input("Annule") ? 1 : 0;
        $visite->Rate  = $request->input("Rate") ? 1 : 0;
        $visite->UserUp = Auth::user()->LoginUSR;
        $visite->DateUp =  date("Y-m-d H:i:s");
        $visite->save();



        return response()->json(['message' => " Visite  est Modifié avec succès !"], 201);
    }

    public function validerVs(Request $request, $IdVis , $IdRD , $idUSR)
    {


        $visite = Visite::find($IdVis);
        $date_rdv =   DB::table('wb_visites')
            ->join('wb_rendezvous', 'wb_visites.IdRD', '=', 'wb_rendezvous.IdRD')
            ->select('wb_rendezvous.DateRD')
            ->where('wb_rendezvous.IdRD' , $IdRD)
            ->get();
           /* $username = DB::table('wb_users')->select('LoginUSR')->where('IdDEP', $IdDEP)->get();
            $date_rdv = Visite::select('wb_visites.*', 'wb_rendezvous.DateRD')
            ->join('wb_rendezvous', 'wb_visites.IdRD', '=', 'wb_rendezvous.IdRD')
            ->get();*/


        $date = $date_rdv->first()->DateRD;

        $date = Carbon::createFromFormat('Y-m-d H:i:s',  $date)->format("d/m/Y H:i:s");

        $username =   DB::table('wb_visites')
        ->join('wb_users', 'wb_visites.idUSR', '=', 'wb_users.idUSR')
        ->select('wb_users.NomUSR')
        ->where('wb_users.idUSR' , $idUSR)
        ->get();

        $visitor_name = $username->first()->NomUSR;

        if (Auth::user()->ValideRD === 0) {
            return response()->json(['error' => " vous n'avez pas la permission !"], 208);
        } else {

            $visite->Valide  = $request->input("Valide") ? 1 : 0;
            $visite->save();

            $details = [

                'title' => 'Email de Visitor',

                'body' => 'vous êtes invité par '  .$visitor_name.  ' le ' .$date.  ' dans la societé XXX',

            ];

            Mail::to('simomar.testing@gmail.com')->send(new \App\Mail\email($details));

            return response()->json(['success' => ' Visite  est Validé avec succès !'], 201);
        }
    }

    public function bloquerVs(Request $request , $IdVis)
    {
        $visite = Visite::find($IdVis);
        if (Auth::user()->BloqueVS  === 0) {
            return response()->json(['error' => " vous n'avez pas la permission !"], 208);
        } else {
            $visite->Annule  = $request->input("Annule") ? 1 : 0;
            $visite->save();

        }
    }

    public function exportCsv(Request $request)
    {
        /*$fileName = 'visites.csv';
   $visites = Visite::all()->toArray();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(   'Id Visite' ,	'Id Visiteur' ,	'Id Rendez-vous' ,	'Id Departement' ,	'Id User' ,	'Raison Visite' ,	'Valide' ,	'Annule' ,	'Check In' ,	'Check Out' 	,'Rate'  	);

        $callback = function() use($visites, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns,';');

            foreach ($visites as $visite) {


                fputcsv($file, array($visite['IdVis'], $visite['IdVS'], $visite['IdRD'], $visite['IdDEP'], $visite['idUSR']
                ,$visite['RaisonVis'], $visite['Valide'], $visite['Annule'], $visite['Check_In'], $visite['Check_Out'] ,$visite['Rate']) , ';' );
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);*/
        $visites = Visite::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
            'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path() . "/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/visites.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [
            "IdVis",
            "IdVS",
            "IdRD",
            "IdDEP",
            "idUSR",
            "RaisonVis",
            "Valide",
            "Annule",
            "Check_In",
            "Check_Out",
            "Rate"
        ], ';');

        //adding the data from the array
        foreach ($visites as $each_visite) {
            fputcsv($handle, [
                $each_visite->IdVis,
                $each_visite->IdVS,
                $each_visite->IdRD,
                $each_visite->IdDEP,
                $each_visite->idUSR,
                $each_visite->RaisonVis,
                $each_visite->Valide,
                $each_visite->Annule,
                $each_visite->Check_In,
                $each_visite->Check_Out,
                $each_visite->Rate,

            ], ";");
        }
        fclose($handle);

        //download command
        return Response::download($filename, "visites.csv", $headers);
    }
    /*public function deleteVisite($IdVis){
        $visite = Visite::find($IdVis);
        $visite->delete();
        return response()->json(['success' , "Visite est supprimer"] , 201);
    }*/
}
