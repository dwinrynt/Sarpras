<?php

use App\Models\Profil;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KomliController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\KompetenController;
use App\Http\Controllers\ProfilDepoController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\KopetensikeahlianController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', RegisteredUserController::class);
    Route::get('/profil/admin', [AdminController::class, 'index']);
    Route::resource('/profil', ProfilController::class);
    Route::patch('/kompeten/tambahsiswa/{id:profil}', [KompetenController::class, 'update']);
    Route::resource('/kompeten', KompetenController::class);
    Route::get('/kompeten/create/{id:profil}', [KompetenController::class, 'create']);
    // Route::resource('/kopetensi', KopetensikeahlianController::class);
    // Route::get('/kopetensi/create/{id:profil}', [KopetensikeahlianController::class, 'create']);
    Route::resource('/koleksi', KoleksiController::class);
    Route::get('/koleksi/create/{id:profil}', [KoleksiController::class, 'create']);
    Route::resource('/foto', FotoController::class);
    Route::get('/foto/create/{koleksi:slug}', [FotoController::class, 'create']);
});

require __DIR__.'/auth.php';
