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

// routes to control deparetemnt
Route::get('/departemnt_view' , [App\Http\Controllers\Admin\DepartementController::class, 'DepartementView']);
Route::get('/api/departements' , [App\Http\Controllers\Admin\DepartementController::class, 'allDepartement'])->name('api.departements');
Route::get('/create_departement_view' , [App\Http\Controllers\Admin\DepartementController::class, 'createDepView']);
Route::post('/store_departement' , [App\Http\Controllers\Admin\DepartementController::class, 'storeDep']);
Route::put('/update_departement/{IdDEP}' , [App\Http\Controllers\Admin\DepartementController::class, 'UpdateDepartement']);

// routes to control RoundezVous
Route::get('/roundezVous' , [App\Http\Controllers\Admin\RendezController::class, 'index']);
Route::get('/api/RendezVous' , [App\Http\Controllers\Admin\RendezController::class, 'allRendezVous'])->name('api.roundez');
Route::post('/store_rendezVous' , [App\Http\Controllers\Admin\RendezController::class, 'storeRendezVous']);
Route::put('/update_rendezVous/{IdRD}', [App\Http\Controllers\Admin\RendezController::class, 'UpdateRendezVous']);
Route::get('/getDetails/{IdVS}', [App\Http\Controllers\Admin\RendezController::class , 'getDetails']);
Route::get('/Dropdown/{IdDEP}' , [App\Http\Controllers\Admin\RendezController::class, 'Dropdown']);

// routes to control Visites
Route::get('/visites' , [App\Http\Controllers\Admin\VisiteController::class, 'visitesView']);
Route::get('/api/visite' , [App\Http\Controllers\Admin\VisiteController::class, 'allVisites'])->name('api.visites');

Route::put('/update_visite/{IdVis}', [App\Http\Controllers\Admin\VisiteController::class, 'updateVisite']);

// routes to control Visiteurs
Route::get('/visiteur' , [App\Http\Controllers\Admin\VisiteurController::class, 'visiteurView']);
Route::get('/api/visiteurs' , [App\Http\Controllers\Admin\VisiteurController::class, 'allVisiteur'])->name('api.visiteur');
Route::put('/update_visiteur/{IdVS}', [App\Http\Controllers\Admin\VisiteurController::class ,  'updateVisiteur']);

// routes to control Journal email
Route::get('/journal_email', [App\Http\Controllers\Admin\EmailController::class , 'journalEmailView']);
Route::post('send_email', [App\Http\Controllers\Admin\EmailController::class, 'storeEmail']);

//routes to control temps Intervalle
Route::get('/events', [App\Http\Controllers\Admin\BlockedTimesController::class , 'allEvents']);
Route::post('/store_events', [App\Http\Controllers\Admin\BlockedTimesController::class , 'storeEvents']);
Route::put('/update_events/{IdBT}', [App\Http\Controllers\Admin\BlockedTimesController::class , 'UpdateEvents']);
Route::get('/api/events', [App\Http\Controllers\Admin\BlockedTimesController::class, 'apiEvents'])->name('api.events');
Route::delete('/delelte_temp_intervalle/{IdBT}' , [App\Http\Controllers\Admin\BlockedTimesController::class , 'DeleteBT']);
//routes to controle TypesVisite
Route::get('/types_view' , [App\Http\Controllers\Admin\TypesVisite::class, 'index']);
Route::get('/api/types' , [App\Http\Controllers\Admin\TypesVisite::class, 'allTypes'])->name('api.types');
Route::post('/storeTypes', [App\Http\Controllers\Admin\TypesVisite::class , 'storeTypes']);
Route::put('/updateTypes/{IdTP}', [App\Http\Controllers\Admin\TypesVisite::class , 'UpadteTypes']);













/*Route::post('/save_user', function () {
    $u = new User();

    $u->LoginUSR = "simo.mrh";
    $u->PassUSR = Hash::make("12345678");
    $u->RoleUSR  = "admin";
    $u->NomUSR  = "mohammed";
    $u->PrenomUSR  = "nnnnnnn";
    $u->EmailUSR  = "sssssssss@email.fr";
    $u->GSMUSR  = "0609990001";
    $u->IdDEP  = 4;
    $u->ValideRD  = 1;
    $u->BloqueVS  = 1;
    $u->UserCr  = date('Y-m-d H:i:s');
    $u->DateCr  =  date('Y-m-d H:i:s');

    $u->save();
    return "user saved";
});*/


require __DIR__ . '/auth.php';
