<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class VisiteurController extends Controller
{
    public function visiteurView(){

        $visiteurs = DB::select('select * from wb_visiteurs');
        $typeVisites = DB::select('select * from wb_type_visite');
        return view('admin.visiteur',compact('visiteurs' , 'typeVisites' ));
       }
       public function allVisiteur(Request $request){
        if($request->ajax()) {
            $visiteur = Visiteur::all();
            return response()->json(["data" => $visiteur]);
        } else {
            abort(404);
        }
    }

       public function updateVisiteur(Request $request , $IdVS){

         $visiteur = Visiteur::find($IdVS);

        $visiteur->NomVS = $request->input('NomVS');
        $visiteur->CINVS = $request->input('CINVS');
        $visiteur->GSMVS = $request->input('GSMVS');
        $visiteur->EmailVS = $request->input('EmailVS');
        $visiteur->SocieteVS = $request->input('SocieteVS');
        $visiteur->UseruP = Auth::user()->LoginUSR;
        $visiteur->DateuP  =  date("Y-m-d H:i:s");
        $visiteur->save();


        return response()->json(['message' => 'Visiteur est Modifié avec succès !'], 201);

       }
       public function visiteurExport(Request $request)
    {

            $visiteurs = Visiteur::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
          'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/visiteurs.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [ 'Id Visiteur' ,' Nom Visiteur' ,'CIN Visiteur' ,' Telephone Visiteur' ,'Email Visiteur' ,' Id TV' ,' Societe Visiteur' ],';');

        //adding the data from the array
        foreach ($visiteurs as $each_visiteur) {
            fputcsv($handle, [
                $each_visiteur->IdVS,
                $each_visiteur->NomVS,
                $each_visiteur->CINVS,
                $each_visiteur->GSMVS,
                $each_visiteur->EmailVS,
                $each_visiteur->IdTP,
                $each_visiteur->SocieteVS,
            ],";");

        }
        fclose($handle);

        //download command
        return Response::download($filename, "visiteurs.csv", $headers);


    }

    public function deleteVisiteur($IdVS){
        $visiteur = Visiteur::find($IdVS);
        $visiteur->delete();
        return response()->json(['success' => "Visiteur est Supprimer"], 201);
    }
}
