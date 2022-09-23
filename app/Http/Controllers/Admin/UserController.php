<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $departements = DB::select("select * from wb_departement ");
        $users = DB::select("select * from wb_users ");
        return view('admin.users', compact('users', 'departements'));
    }


    public function allUsers(Request $request){
        if($request->ajax()) {
            $users = User::all();
            return response()->json(["data" => $users]);
        } else {
            abort(404);
        }
    }

    public function createUserView()
    {
        return view('admin.createUser');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'LoginUSR' => "required",
            'PassUSR'  => "required",
            'RoleUSR'   => "required",
            'NomUSR'   => "required",
            'PrenomUSR'   => "required",
            'GSMUSR'   => "required",
            'EmailUSR '  => "email",
            'IdDEP'   => "required|min:1|max:5",
        ]);

        $exist = User::where(['LoginUSR' => $request->input("LoginUSR")])->first();


        if (!empty($exist)) {
            return response()->json(["error" => "Utilisateur déja exister"], 208);
        }


        $user = new User();
        $user->LoginUSR = $request->input("LoginUSR");
        $user->PassUSR = Hash::make($request->input("PassUSR"));
        $user->RoleUSR  =  $request->input("RoleUSR");
        $user->NomUSR  =  $request->input("NomUSR");
        $user->PrenomUSR  =  $request->input("PrenomUSR");
        $user->EmailUSR  =  $request->input("EmailUSR");
        $user->GSMUSR = $request->input("GSMUSR");
        $user->IdDEP  = $request->input("IdDEP");
        $user->ValideRD  = $request->input("ValideRD")? 1 : 0;
        $user->BloqueVS = $request->input("BloqueVS")? 1 : 0;
        $user->UserCr = Auth::user()->LoginUSR;
        $user->DateCr  =  date("Y-m-d H:i:s");


        $user->save();

        return response()->json(['success' => 'Utilisateur est Créé avec succès !'], 201);
    }

    public function updateUser(Request $request, $idUSR)
    {

        // DB::select('select * from wb_users where idUSR = ?', [$idUSR]);
        $user = User::find($idUSR);

        $user->LoginUSR = $request->input("LoginUSR");
        $user->PassUSR = Hash::make($request->input("PassUSR"));
        $user->RoleUSR  =  $request->input("RoleUSR");
        $user->NomUSR  =  $request->input("NomUSR");
        $user->PrenomUSR  =  $request->input("PrenomUSR");
        $user->EmailUSR  =  $request->input("EmailUSR");
        $user->GSMUSR = $request->input("GSMUSR");
        $user->IdDEP  = $request->input("IdDEP");
        $user->ValideRD  = $request->input("ValideRD")? 1 : 0;
        $user->BloqueVS = $request->input("BloqueVS")? 1 : 0;
        $user->UserUp = Auth::user()->LoginUSR;
        $user->DateUp  =  date("Y-m-d H:i:s");
        $user->save();
        /* DB::update(
            'update wb_users set LoginUSR = ? , PassUSR=? , RoleUSR=? , NomUSR=? , PrenomUSR=? , EmailUSR=? , GSMUSR=? , IdDEP=? where idUSR = ?',
            [$user->LoginUSR, $user->PassUSR, $user->RoleUSR, $user->NomUSR, $user->PrenomUSR, $user->EmailUSR, $user->GSMUSR, $user->IdDEP, $idUSR]
        );*/
        /*  DB::table('wb_users')->whereIn('idUSR', $idUSR)->update($request->all());*/

        return response()->json(['message' => 'Utilisateur est Modifié avec succès!'], 201);
    }
}
