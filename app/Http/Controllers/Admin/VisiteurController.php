<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Visiteur;
use Illuminate\Http\Request;

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
}
