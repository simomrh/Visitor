<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeVisite;
use Illuminate\Support\Facades\Auth;

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
        return response()->json(["success" , "Type de Visite Modifié avec succès"] ,201);
    }
    public function deleteType($IdTP){
        $typeVisite = TypeVisite::find($IdTP);
        $typeVisite->delete();
        return response()->json(["success" , "Type de Visite Supprimer "] ,201);
    }
}
