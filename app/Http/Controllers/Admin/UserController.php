<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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
            'PrenomUSR'   => "required|password",
            'GSMUSR'   => "required",
            'EmailUSR '  => "email",
            'IdDEP'   => "required|",
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
    public function usersExport(Request $request)
    {

            $users = User::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
          'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/utilisateurs.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [ 'Id User' ,'Username' ,'Password' ,	'Role' ,'Nom ' ,'Prenom' ,'Telephone' ,'Email' ,'Id Departement' ,'Valide Rendez-vous' ,'Bloquer Visiteur' ],';');

        //adding the data from the array
        foreach ($users as $each_user) {
            fputcsv($handle, [
                $each_user->idUSR,
                $each_user->LoginUSR,
                $each_user->PassUSR,
                $each_user->NomUSR,
                $each_user->RoleUSR,
                $each_user->PrenomUSR,
                $each_user->GSMUSR,
                $each_user->EmailUSR,
                $each_user->IdDEP,
                $each_user->ValideRD,
                $each_user->BloqueVS,

            ],";");

        }
        fclose($handle);

        //download command
        return Response::download($filename, "utilisateurs.csv", $headers);


    }
}
