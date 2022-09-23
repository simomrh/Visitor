<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Departement;

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
}
