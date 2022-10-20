<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RendezController;
use App\Http\Controllers\Admin\VisiteControlle;
use App\Http\Controllers\Admin\VisiteurControlle;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/welcome', function () {
    return view('welcome');
});*/

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Dashboard\DashboardController::class, 'Redirect'])
        ->name('dashboard');

});
// Routes For Admin

// routes to control users
Route::get('/users' , [App\Http\Controllers\Admin\UserController::class, 'index']);
Route::get('/api/users' , [App\Http\Controllers\Admin\UserController::class, 'allUsers'])->name('api.users');
Route::get('/add_user_view' , [App\Http\Controllers\Admin\UserController::class, 'createUserView']);
Route::post('/store_user' , [App\Http\Controllers\Admin\UserController::class, 'storeUser']);
Route::put('/update_user/{idUSR}' , [App\Http\Controllers\Admin\UserController::class, 'updateUser']);
Route::get('/exportusers',[App\Http\Controllers\Admin\UserController::class , 'usersExport']);

// routes to control deparetemnt
Route::get('/departemnt_view' , [App\Http\Controllers\Admin\DepartementController::class, 'DepartementView']);
Route::get('/api/departements' , [App\Http\Controllers\Admin\DepartementController::class, 'allDepartement'])->name('api.departements');
Route::get('/create_departement_view' , [App\Http\Controllers\Admin\DepartementController::class, 'createDepView']);
Route::post('/store_departement' , [App\Http\Controllers\Admin\DepartementController::class, 'storeDep']);
Route::put('/update_departement/{IdDEP}' , [App\Http\Controllers\Admin\DepartementController::class, 'UpdateDepartement']);
Route::get('/exportDepartement', [App\Http\Controllers\Admin\DepartementController::class, 'exportDep']);
Route::delete('/delete_departement/{IdDEP}', [App\Http\Controllers\Admin\DepartementController::class , 'deleteDep']);

// routes to control RoundezVous
Route::get('/roundezVous' , [App\Http\Controllers\Admin\RendezController::class, 'index']);
Route::get('/api/RendezVous' , [App\Http\Controllers\Admin\RendezController::class, 'allRendezVous'])->name('api.roundez');
Route::post('/store_rendezVous' , [App\Http\Controllers\Admin\RendezController::class, 'storeRendezVous']);
Route::put('/update_rendezVous/{IdRD}', [App\Http\Controllers\Admin\RendezController::class, 'UpdateRendezVous']);
Route::get('/exportRendezVous' , [App\Http\Controllers\Admin\RendezController::class, 'rendezExport']);
Route::get('/getDetails/{IdVS}', [App\Http\Controllers\Admin\RendezController::class , 'getDetails']);
Route::delete('/delete_rendez_vous/{IdRD}', [App\Http\Controllers\Admin\RendezController::class, 'deleteRD']);
Route::put('/valider_rdv/{IdRD}',[App\Http\Controllers\Admin\RendezController::class , 'validerRDV']);
Route::put('/block_rdv/{IdRD}',[App\Http\Controllers\Admin\RendezController::class , 'blockRD']);
Route::get('/confirmerRDV/{IdRD}',[App\Http\Controllers\Admin\RendezController::class , 'ConfirmRdv']);
Route::get('/refuserRDV/{IdRD}' , [App\Http\Controllers\Admin\RendezController::class, 'refuserRDV']);
// routes to control Visites
Route::get('/visites' , [App\Http\Controllers\Admin\VisiteController::class, 'visitesView']);
Route::get('/api/visite' , [App\Http\Controllers\Admin\VisiteController::class, 'allVisites'])->name('api.visites');
Route::put('/update_visite/{IdVis}', [App\Http\Controllers\Admin\VisiteController::class, 'updateVisite']);
Route::get('/exportVisite', [App\Http\Controllers\Admin\VisiteController::class, 'exportCsv']);
Route::get('/export', [App\Http\Controllers\Admin\VisiteController::class, 'Csv']);
Route::put('/bloquer_visite/{IdVis}',[App\Http\Controllers\Admin\VisiteController::class , 'bloquerVs']);
Route::delete('/delete_visite/{IdVis}' , [App\Http\Controllers\Admin\VisiteController::class , 'deleteVisite']);

// routes to control Visiteurs
Route::get('/visiteur' , [App\Http\Controllers\Admin\VisiteurController::class, 'visiteurView']);
Route::get('/api/visiteurs' , [App\Http\Controllers\Admin\VisiteurController::class, 'allVisiteur'])->name('api.visiteur');
Route::put('/update_visiteur/{IdVS}', [App\Http\Controllers\Admin\VisiteurController::class ,  'updateVisiteur']);
Route::get('/exportVisiteur' , [App\Http\Controllers\Admin\VisiteurController::class , 'visiteurExport']);
Route::delete('/delete_visiteur/{IdVS}', [App\Http\Controllers\Admin\VisiteurController::class , 'deleteVisiteur']);

// routes to control Journal email


//routes to control temps Intervalle
Route::get('/BTview', [App\Http\Controllers\Admin\BlockedTimesController::class , 'allBlockedTimes']);
Route::post('/storeBT', [App\Http\Controllers\Admin\BlockedTimesController::class , 'storeBT']);
Route::put('/updateBT/{IdBT}', [App\Http\Controllers\Admin\BlockedTimesController::class , 'UpdateBT']);
Route::get('/api/BT', [App\Http\Controllers\Admin\BlockedTimesController::class, 'apiBT'])->name('api.BT');
Route::delete('/delelteBT/{IdBT}' , [App\Http\Controllers\Admin\BlockedTimesController::class , 'DeleteBT']);
Route::get('/exportBT', [App\Http\Controllers\Admin\BlockedTimesController::class , 'btExport']);

//routes to controle TypesVisite
Route::get('/types_view' , [App\Http\Controllers\Admin\TypesVisite::class, 'index']);
Route::get('/api/types' , [App\Http\Controllers\Admin\TypesVisite::class, 'allTypes'])->name('api.types');
Route::post('/storeTypes', [App\Http\Controllers\Admin\TypesVisite::class , 'storeTypes']);
Route::put('/updateTypes/{IdTP}', [App\Http\Controllers\Admin\TypesVisite::class , 'UpadteTypes']);
Route::get('/exportTP', [App\Http\Controllers\Admin\TypesVisite::class, 'tpExport']);


//response email


/*Route::get('send-mail', function () {






    dd("Email is Sent.");

});*/







/*Route::post('/llllllll', function () {
    $u = new User();

    $u->LoginUSR = "mohamed1";
    $u->PassUSR = Hash::make("12345678");
    $u->RoleUSR  = "admin";
    $u->NomUSR  = "mohamed";
    $u->PrenomUSR  = "mohamed";
    $u->EmailUSR  = "mohamed.3@email.fr";
    $u->GSMUSR  = "0609990001";
    $u->IdDEP  = '1';

    $u->UserCr  = 'mohamed';
    $u->DateCr  =  date('Y-m-d H:i:s');

    $u->save();
     dd($u);
});*/


require __DIR__ . '/auth.php';
