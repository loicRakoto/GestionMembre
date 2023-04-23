<?php

use App\Http\Controllers\activiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\membreController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\userController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', DashboardController::class)->name('dashboard')->middleware('auth');

Route::group(['middleware' => ['auth', PreventBackHistory::class]], function () {

    // Vos routes ici

});

Route::get('/membre', [membreController::class, 'index'])->name('membre.index');
Route::post('/membre/add', [membreController::class, 'store'])->name('membre.store');
Route::get('/fetchData', [membreController::class, 'fetchdata'])->name('membre.fetch');
Route::get('/membre/edit', [membreController::class, 'edit'])->name('membre.edit');
Route::post('/membre/update', [membreController::class, 'update'])->name('membre.update');
Route::get('/membre/delete', [membreController::class, 'destroy'])->name('membre.destroy');
Route::get('/membre/search', [membreController::class, 'find'])->name('membre.find');

Route::get('/activite', [activiteController::class, 'index'])->name('activite.index');
Route::put('/activite/add', [activiteController::class, 'store'])->name('activite.store');


///////////////////////////////////////////////////////////////////////////////////////////
Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/authenticate', [loginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [loginController::class, 'logout'])->name('login.logout');

Route::post('/addUser', [userController::class, 'store'])->name('user.store');
