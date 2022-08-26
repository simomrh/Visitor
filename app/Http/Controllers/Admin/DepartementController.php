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



    public function storeDep(Request $req)
    {
        try{
        $req->validate([
            'NomDEP' => "required",

        ]);

        $exist = Departement::where(['NomDEP' => $req->input("NomDEP")])->first();


        if (!empty($exist)) {
            return response()->json(["error" => "the Departement already exist"], 208);
        }

        $departement = new Departement();
        $departement->NomDEP = $req->input('NomDEP');
        $departement->UserCr = Auth::user()->LoginUSR;
        $departement->DateCr  =  date("Y-m-d H:i:s");
        $departement->save();
        return response()->json(['success' => 'Departement is successfully cretaed !'], 201);
    } catch(\Exception $e){
        return $e->getMessage();
    }
    }


}
