<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MatrixController;
use App\Http\Controllers\admin\RankingController;
use App\Http\Controllers\admin\KriteriaController;
use App\Http\Controllers\puskesmas\DataController;
use App\Http\Controllers\admin\AlternatifController;
use App\Http\Controllers\dinkes\PuskesmasController;
use App\Http\Controllers\admin\SubKriteriaController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'post'])->name('login.post');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard');
    
    
    Route::prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria');
        Route::get('/tambah', [KriteriaController::class, 'create'])->name('kriteria.tambah');
        Route::post('/tambah', [KriteriaController::class, 'post'])->name('kriteria.post');
        Route::get('/{id}/ubah', [KriteriaController::class, 'edit'])->name('kriteria.ubah');
        Route::put('/{id}/ubah', [KriteriaController::class, 'put'])->name('kriteria.put');
    });
    
    Route::prefix('sub-kriteria')->group(function () {
        Route::get('/', [SubKriteriaController::class, 'index'])->name('sub-kriteria');
        Route::get('/tambah', [SubKriteriaController::class, 'create'])->name('sub-kriteria.tambah');
        Route::post('/tambah', [SubKriteriaController::class, 'post'])->name('sub-kriteria.post');
    });    
    
    Route::prefix('alternatif')->group(function () {
        Route::get('/', [AlternatifController::class, 'index'])->name('alternatif');
        Route::get('/tambah', [AlternatifController::class, 'create'])->name('alternatif.tambah');
        Route::post('/tambah', [AlternatifController::class, 'post'])->name('alternatif.post');
        Route::get('/{id}/ubah', [AlternatifController::class, 'edit'])->name('alternatif.ubah');
        Route::put('/{id}/ubah', [AlternatifController::class, 'put'])->name('alternatif.put');
        Route::delete('/{id}/hapus', [AlternatifController::class, 'delete'])->name('alternatif.delete');
    });
    
    Route::prefix('matrix')->group(function () {
        Route::get('/', [MatrixController::class, 'index'])->name('matrix');
        Route::get('/{id}', [MatrixController::class, 'show'])->name('matrix.show');
        Route::post('/{id}', [MatrixController::class, 'post'])->name('matrix.post');
    });
    
    Route::prefix('ranking')->group(function () {
        Route::get('/', [RankingController::class, 'index'])->name('ranking');
        Route::get('/{id}', [RankingController::class, 'show'])->name('ranking.show');
        
    });
    
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::get('/tambah', [UserController::class, 'create'])->name('user.tambah');
        Route::post('/tambah', [UserController::class, 'post'])->name('user.post');
        Route::get('/{id}/ubah', [UserController::class, 'edit'])->name('user.ubah');
        Route::put('/{id}/ubah', [UserController::class, 'put'])->name('user.put');
        Route::put('/{id}/password', [UserController::class, 'password'])->name('user.password');
    });
    
    
    
    // =========================================================================================== //
    
    Route::get('/data', [DataController::class, 'index'])->name('puskesmas.data');
    Route::post('/data', [DataController::class, 'post'])->name('puskesmas.data.post');
    
    // =========================================================================================== //
    
    Route::prefix('puskesmas')->group(function () {
        Route::get('/', [PuskesmasController::class, 'index'])->name('dinkes.puskesmas');
        Route::get('/{id}/rangking', [PuskesmasController::class, 'rangking'])->name('dinkes.puskesmas.ranking');
        Route::get('/{id}/rekap', [PuskesmasController::class, 'rekap'])->name('dinkes.puskesmas.rekap');
        Route::get('/{id}/rekap/tambah', [PuskesmasController::class, 'tambahRekap'])->name('dinkes.puskesmas.rekap.tambah');
        Route::post('/{id}/rekap/tambah', [PuskesmasController::class, 'postRekap'])->name('dinkes.puskesmas.rekap.post');
    });
    // Route::prefix('puskesmas')->group(function () {
    //     Route::get('/', [DataController::class, 'puskesmas'])->name('puskesmas');
    // });
    
    
});