<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('loginaksi', [LoginController::class, 'loginaksi'])->name('loginaksi');
Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('logoutaksi', [LoginController::class, 'logoutaksi'])->name('logoutaksi');
});

Route::get('registrasi', [UserController::class, 'registrasi'])->name('registrasi');
Route::post('registrasi', [UserController::class, 'registrasi_aksi'])->name('registrasi.action');
Route::post('registrasilogin', [UserController::class, 'registrasi_aksi_login'])->name('registrasi.action.login');
Route::post('delete-registrasi/{id}', [UserController::class, 'hapusregistrasi'])->name('registrasi.hapusregistrasi');
Route::put('registrasi/update/{id}', [UserController::class, 'updateregistrasi'])->name('registrasi.updateregistrasi');

Route::get('pasien', [PasienController::class, 'pasien'])->name('pasien');
Route::post('pasien', [PasienController::class, 'pasien_aksi'])->name('pasien.action');
Route::post('delete-pasien/{id}', [PasienController::class, 'hapuspasien'])->name('pasien.hapuspasien');
Route::get('pasien/edit/{id}', [PasienController::class, 'editpasien'])->name('pasien.editpasien');
Route::post('pasien/update/{id}', [PasienController::class, 'updatepasien'])->name('pasien.updatepasien');

Route::get('penimbangan', [PasienController::class, 'penimbangan'])->name('penimbangan');
Route::post('penimbangan/update/{id}', [PasienController::class, 'updatepenimbangan'])->name('penimbangan.updatepenimbangan');
Route::post('delete-penimbangan/{id}', [PasienController::class, 'hapuspenimbangan'])->name('penimbangan.hapuspenimbangan');


Route::get('imunisasi', [PasienController::class, 'imunisasi'])->name('imunisasi');
Route::post('imunisasi/update/{id}', [PasienController::class, 'updateimunisasi'])->name('imunisasi.updateimunisasi');
Route::post('delete-imunisasi/{id}', [PasienController::class, 'hapusimunisasi'])->name('imunisasi.hapusimunisasi');


Route::get('stunting', [PasienController::class, 'stunting'])->name('stunting');
Route::post('stunting/update/{id}', [PasienController::class, 'updatestunting'])->name('stunting.updatestunting');
Route::post('delete-stunting/{id}', [PasienController::class, 'hapusstunting'])->name('stunting.hapusstunting');


Route::get('obat', [PasienController::class, 'obat'])->name('obat');
Route::post('obat/update/{id}', [PasienController::class, 'updateobat'])->name('obat.updateobat');
Route::post('delete-obat/{id}', [PasienController::class, 'hapusobat'])->name('obat.hapusobat');



Route::get('tampilpasien', [PasienController::class, 'tampilpasien'])->name('tampilpasien');
Route::post('cari/pasien', [PasienController::class, 'caripasien'])->name('pasien.caripasien');

