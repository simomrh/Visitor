<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedTimes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class BlockedTimesController extends Controller
{
    public function allBlockedTimes()
    {

        $departements = DB::select('select * from wb_departement');
        $visiteurs = DB::select("select * from wb_visiteurs");
        return view('admin.BlockedTimes', compact('visiteurs', 'departements'));
    }

    public function apiBT(Request $request)
    {
        if ($request->ajax()) {
            $events = BlockedTimes::all();
            return response()->json(["data" => $events]);
        } else {
            abort(404);
        }
    }

    public function storeBT(Request $request)
    {
        $request->validate([
            'DateDeb' => "required",
            'DateFin' => "required",
            'IdDEP' => "required",
        ]);

        $date_deb = \DateTime::createFromFormat("Y-m-d\TH:i", $request->input("DateDeb"))->format('Y-m-d H:i:s');
        $date_fin = \DateTime::createFromFormat("Y-m-d\TH:i", $request->input("DateFin"))->format('Y-m-d H:i:s');

        $exist_dates = DB::select("select IdBT, DateDeb, DateFin from wb_blocked_time where ? BETWEEN DateDeb  AND DateFin ", [$date_deb] , [$date_fin]);
        if(!empty($exist_dates)){
            return response()->json(['error' => 'temp intervalle déja exist'] , 208);
        }
        $blocked_dates = new BlockedTimes();

        $blocked_dates->DateDeb = $request->input('DateDeb');
        $blocked_dates->DateFin = $request->input('DateFin');
        $blocked_dates->IdDEP = $request->input('IdDEP');

        $blocked_dates->UserCr = Auth::user()->LoginUSR;
        $blocked_dates->DateCr =  date("Y-m-d H:i:s");

        $blocked_dates->save();
        return response()->json(['message' => ' Temps Intervalle  est créé avec succès !'], 201);
    }
    public function UpdateBT(Request $request, $IdBT)
    {

        $blocked_dates = BlockedTimes::find($IdBT);

        $blocked_dates->DateDeb = $request->input('DateDeb');
        $blocked_dates->DateFin = $request->input('DateFin');
        $blocked_dates->IdDEP = $request->input('IdDEP');

        $blocked_dates->UserUp = Auth::user()->LoginUSR;
        $blocked_dates->DateUp =  date("Y-m-d H:i:s");
        $blocked_dates->save();
        return response()->json(['message' => ' Temps Intervalle  est Modifié avec succès !'], 201);
    }

    public function DeleteBT($IdBT)
    {
        $blocked_dates = BlockedTimes::find($IdBT);
        $blocked_dates->delete();
        return response()->json(['success' => ' Temps Intervalle  est Supprimer !'], 201);
    }

    public function btExport(Request $request){
        $blockedTimes = BlockedTimes::get();

        // these are the headers for the csv file. Not required but good to have one incase of system didn't recongize it properly
        $headers = array(
          'Content-Type' => 'text/csv'
        );


        //I am storing the csv file in public >> files folder. So that why I am creating files folder
        if (!File::exists(public_path()."/files")) {
            File::makeDirectory(public_path() . "/files");
        }

        //creating the download file
        $filename =  public_path("files/tempsIntervalles.csv");
        $handle = fopen($filename, 'w');

        //adding the first row
        fputcsv($handle, [ 'Id Temps Intervalles' ,' Date Debut' , 'Date Fin', 'Id Departement'  ],';');

        //adding the data from the array
        foreach ($blockedTimes as $each_blockedTime) {
            fputcsv($handle, [
                $each_blockedTime->IdBT,
                $each_blockedTime->DateDeb,
                $each_blockedTime->DateFin,
                $each_blockedTime->IdDEP
            ],";");

        }
        fclose($handle);

        //download command
        return Response::download($filename, "TempIntervalles.csv", $headers);
    }
}
