<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Visite;
class VisiteController extends Controller
{
    public function visitesView(){
        $visites = DB::select('select * from  wb_visites');
        return view('admin.visites' , compact('visites'));
       }

       public function allVisites(Request $request){
        if($request->ajax()) {
            $visite = Visite::all();
            return response()->json(["data" => $visite]);
        } else {
            abort(404);
        }
    }

      public function updateVisite(Request $request , $IdVis){

        $visite = Visite::find($IdVis);

        $visite->Check_In = $request->input("Check_In");
        $visite->Check_Out  = $request->input("Check_Out");
        $visite->Valide  = $request->input("Valide")? 1 : 0;
        $visite->Annule  = $request->input("Annule")? 1 : 0;
        $visite->Rate  = $request->input("Rate")? 1 : 0;
        $visite->UserUp = Auth::user()->LoginUSR;
        $visite->DateUp =  date("Y-m-d H:i:s");
        $visite->save();



            return response()->json(['message' => ' Visite  est Modifié avec succès !'], 201);
      }
}
