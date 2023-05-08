<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UtilisateurController;

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
    return view('index');
});
Route::post('/Signin',UtilisateurController::class . '@Signin');
Route::get('/Logout',UtilisateurController::class . '@Logout');
Route::get('/ToSignUp',function(){ return view('Signup'); });
Route::post('/Signup',UtilisateurController::class . '@Signup');
Route::get('/ForgetPass',function() { return view('ForgetPassword'); });
Route::post('/ResetPass',UtilisateurController::class . '@ForgetPassword');
Route::get('/Home',UtilisateurController::class . '@toHome')->name("Home");
Route::get('/ToSearch',UtilisateurController::class . '@toSearch');
Route::match(['get', 'post'], '/Search', UtilisateurController::class . '@Search');
Route::get('/Details/{slug}',UtilisateurController::class . '@getDetails');
