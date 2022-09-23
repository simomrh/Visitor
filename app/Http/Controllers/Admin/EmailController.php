<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    //
    public function journalEmailView(){
        return view('admin.journalEmail');
    }

    public function sendEmail(Request $request){

        $request->validate([
            'Email_Emetteur' => "required",
            'Nom_Emetteur'=> "required",
            'Objet' => "required",
            'subject'  => "required",
            'Corp'  => "required",
            'Pieds' => "nullable",
        ]);

        $email = new Email();

        $email->Email_Emetteur = $request->input('Email_Emetteur');
        $email->Nom_Emetteur = $request->input('Nom_Emetteur');
        $email->Objet = $request->input('Objet');
        $email->subject = $request->input('subject');
        $email->Corp = $request->input('Corp');
        $email->Pieds = $request->input('Pieds');
        $email->save();

        return response()->json(['message']);

    }
}
