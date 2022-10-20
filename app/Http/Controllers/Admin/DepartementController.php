<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DepartementController extends Controller
{
    public function DepartementView()
    {
        $departements = DB::select("select * from wb_departement ");
        return view('admin.departement', compact('departements'));
    }

    public function allDepartement(Request $request){
        if($request->ajax()) {
            $departement = Departement::all();
            return response()->json(["data" => $departement]);
        } else {
            abort(404);
        }
    }
    public function storeDep(Request $req)
    {
        try {
            $req->validate([
                'NomDEP' => "required",

            ]);

            $exist = Departement::where(['NomDEP' => $req->input("NomDEP")])->first();


            if (!empty($exist)) {
                return response()->json(["error" => "Departement est déja exister"], 208);
            }

            $departement = new Departement();
            $departement->NomDEP = $req->input('NomDEP');
            $departement->UserCr = Auth::user()->LoginUSR;
            $departement->DateCr  =  date("Y-m-d H:i:s");
            $departement->save();
            return response()->json(['success' => 'Departement est Créé avec succès !'], 201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function UpdateDepartement(Request $request, $IdDEP)
    {
        $departement = Departement::find($IdDEP);

        $departement->NomDEP = $request->input('NomDEP');
        $departement->UserUp = Auth::user()->LoginUSR;
        $departement->DateUp  =  date("Y-m-d H:i:s");
        $departement->save();
        return response()->json(['message' => 'Departement est Modifié avec succès   !'], 201);
    }
    public function exportDep(Request $request)
    {

            $departements = Departement::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
          'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/departement.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [ 'Id departement' ,' Nom departement' ],';');

        //adding the data from the array
        foreach ($departements as $each_departement) {
            fputcsv($handle, [
                $each_departement->IdDEP,
                $each_departement->NomDEP,
            ],";");

        }
        fclose($handle);

        //download command
        return Response::download($filename, "departement.csv", $headers);
      

    }
    public function deleteDep($IdDEP){
        $departement = Departement::find($IdDEP);
        $departement->delete();
        return response()->json(['message' => "Temps Intervalle  est Supprimer"], 201);
    }
}
