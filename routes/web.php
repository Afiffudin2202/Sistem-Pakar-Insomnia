<?php

use App\Models\Gejala;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\PenyakitController;
use App\Models\Penyakit;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAuth']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerStore']);
});

Route::get('/', function () {
    return view('home');
});
Route::get('/beranda', function () {
    return view('home');
});

Route::get('/diagnosa', function () {
    return view('diagnosa');
});
Route::get('/informasi', function () {
    return view('informasi');
});

// middleware route untuk logout dan menu diagnosa
Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::get('/diagnosa/pertanyaan', [DiagnosaController::class, 'index']);
    Route::post('/diagnosa/pertanyaan/store', [DiagnosaController::class, 'store']);
    Route::get('/detailhasil', [DiagnosaController::class, 'detailHasil'])->name('detailhasil');
    route::get('/riwayatdiagnosa', [RiwayatController::class, 'riwayatPasien']);
    Route::get('/cetak-detailhasil/{id}', [RiwayatController::class, 'cetakHasil']);
});

// dashboard admin
Route::middleware(['auth', 'checkRole'])->group(function () {
    Route::get('/dashboard', function () {
        $gejala = Gejala::count();
        $penyakit = Penyakit::count();
        return view('dashboard.index', compact('gejala', 'penyakit'));
    });
    // penyakit
    Route::get('/dashboard/penyakit', [PenyakitController::class, 'index']);
    Route::post('/dashboard/penyakit/store', [PenyakitController::class, 'store']);
    Route::put('/dashboard/penyakit/edit/{kd_penyakit}', [PenyakitController::class, 'update']);
    Route::delete('/dashboard/penyakit/{kd_penyakit}', [PenyakitController::class, 'destroy']);
    // gejala
    Route::get('/dashboard/gejala', [GejalaController::class, 'index']);
    Route::post('/dashboard/gejala/store', [GejalaController::class, 'store']);
    Route::put('/dashboard/gejala/edit/{kd_gejala}', [GejalaController::class, 'update']);
    Route::delete('/dashboard/gejala/{kd_gejala}', [GejalaController::class, 'destroy']);
    // rule
    Route::get('/dashboard/rule', [RuleController::class, 'index']);
    Route::post('/dashboard/rule/store', [RuleController::class, 'store']);
    Route::put('/dashboard/rule/edit/{kd_rule}', [RuleController::class, 'update']);
    Route::delete('/dashboard/rule/{kd_rule}', [RuleController::class, 'destroy']);

    // user diagnosa
    Route::get('/dashboard/riwayat', [RiwayatController::class, 'index']);
    Route::delete('/dashboard/riwayat/{id}', [RiwayatController::class, 'destroy']);
});
