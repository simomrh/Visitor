<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeVisite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class TypesVisite extends Controller
{
    public function index(){
        return view('admin.typeVisite');
    }
    public function allTypes(Request $request){
        if($request->ajax()) {
            $typeVisite = TypeVisite::all();
            return response()->json(["data" => $typeVisite]);
        } else {
            abort(404);
        }
    }
    public function storeTypes(Request $request)
    {
        $request->validate([
            'NomTP' => 'required',
        ]);
        $exist = TypeVisite::where(['NomTP' => $request->input('NomTP')])->first();
        if(!empty($exist)) {
            return response()->json(["error" => "Type visite déja exist"]);
        }
        $typeVisite = new TypeVisite();
        $typeVisite->NomTP = $request->input('NomTP');
        $typeVisite->UserCr = Auth::user()->LoginUSR;
        $typeVisite->DateCr  =  date("Y-m-d H:i:s");
        $typeVisite->save();
        return response()->json(['success' => 'Type de Visite Créé avec succès !'], 201);
    }
    public function UpadteTypes(Request $request, $IdTP)
    {

        $typeVisite = TypeVisite::find($IdTP);
        $typeVisite->NomTP = $request->input('NomTP');
        $typeVisite->UserUp = Auth::user()->LoginUSR;
        $typeVisite->DateUp  =  date("Y-m-d H:i:s");
        $typeVisite->save();
        return response()->json(['message' => 'Type de Visite Modifié avec succès'] ,201);
    }
    public function deleteType($IdTP){
        $typeVisite = TypeVisite::find($IdTP);
        $typeVisite->delete();
        return response()->json(["message" => "Type de Visite Supprimer "] ,201);
    }

    public function tpExport(Request $request){
        $typeVisite = TypeVisite::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
          'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/download.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [ 'Id Type Visite' ,'Type Visite'],';');

        //adding the data from the array
        foreach ($typeVisite as $each_item) {
            fputcsv($handle, [
                $each_item->IdTP,
                $each_item->NomTP,
            ],";");

        }
        fclose($handle);

        //download command
        return Response::download($filename, "TempIntervalles.csv", $headers);
    }
}
