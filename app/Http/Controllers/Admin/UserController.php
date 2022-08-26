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
        return view('admin.users', compact('users' , 'departements'));
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
            return response()->json(["error" => "the user already exist"] , 208);
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
        $user->UserCr = Auth::user()->LoginUSR;
        $user->DateCr  =  date("Y-m-d H:i:s");

        $user->save();

        return response()->json(['success' => 'user is successfully cretaed !'], 201);
    }

    public function updateUser(Request $request ){

        $user = User::find('idUSR');
        $user->LoginUSR = $request->input("LoginUSR");
        $user->PassUSR = Hash::make($request->input("PassUSR"));
        $user->RoleUSR  =  $request->input("RoleUSR");
        $user->NomUSR  =  $request->input("NomUSR");
        $user->PrenomUSR  =  $request->input("PrenomUSR");
        $user->EmailUSR  =  $request->input("EmailUSR");
        $user->GSMUSR = $request->input("GSMUSR");
        $user->IdDEP  = $request->input("IdDEP");
        $user->UserUp = Auth::user()->LoginUSR;
        $user->DateUp  =  date("Y-m-d H:i:s");
        $user->save();
        return response()->json(['success' => 'user is successfully cretaed !'], 201);

    }
}
