<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RendezController;
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
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'Redirect'])
        ->name('dashboard');

});
// Routes For Admin
Route::get('/roundezVous' , [App\Http\Controllers\Admin\RendezController::class, 'index']);

Route::get('/users' , [App\Http\Controllers\Admin\UserController::class, 'index']);
Route::get('/add_user_view' , [App\Http\Controllers\Admin\UserController::class, 'createUserView']);
Route::post('/store_user' , [App\Http\Controllers\Admin\UserController::class, 'storeUser']);
Route::put('/update_user/{idUSR}' , [App\Http\Controllers\Admin\UserController::class, 'updateUser']);


Route::get('/departemnt_view' , [App\Http\Controllers\Admin\DepartementController::class, 'DepartementView']);
Route::get('/create_departement_view' , [App\Http\Controllers\Admin\DepartementController::class, 'createDepView']);
Route::post('/store_departement' , [App\Http\Controllers\Admin\DepartementController::class, 'storeDep']);


















Route::get('/save_user', function () {
    $u = new User();

    $u->LoginUSR = "user.1";
    $u->PassUSR = Hash::make("azerty");
    $u->RoleUSR  = "user";
    $u->NomUSR  = "User";
    $u->PrenomUSR  = "Prenom";
    $u->EmailUSR  = "test1@email.fr";
    $u->GSMUSR  = "0600000001";
    $u->IdDEP  = 11;
    $u->ValideRD  = 1;
    $u->BloqueVS  = 0;
    $u->UserCr  = date('Y-m-d H:i:s');
    $u->DateCr  =  date('Y-m-d H:i:s');

    $u->save();
    return "user saved";
});


require __DIR__ . '/auth.php';
