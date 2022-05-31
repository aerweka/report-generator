<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\GrupController;
use App\Http\Controllers\JenisLaporanController;

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

Route::group(['middleware' => 'is_verified',], function () {
});

Route::group([
    'prefix' => 'laporan',
    'as' => 'laporan.',
], function () {
    Route::get('/', [LaporanController::class, 'index'])->name('index');
    Route::get('/create', [LaporanController::class, 'create'])->name('create');
    Route::post('/store', [LaporanController::class, 'store'])->name('store');
    Route::get('/show/{id}', [LaporanController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [LaporanController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [LaporanController::class, 'update'])->name('update');
    Route::post('/filter', [LaporanController::class, 'cutOffFilter'])->name('filter');
});

Route::group([
    'prefix' => 'grup',
    'as' => 'grup.',
], function () {
    Route::get('/', [GrupController::class, 'index'])->name('index');
    Route::get('/create', [GrupController::class, 'create'])->name('create');
    Route::post('/store', [GrupController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GrupController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [GrupController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [GrupController::class, 'destroy'])->name('destroy');
});

Route::group([
    'prefix' => 'jenis-laporan',
    'as' => 'jenis-laporan.',
], function () {
    Route::get('/', [JenisLaporanController::class, 'index'])->name('index');
    Route::get('/create', [JenisLaporanController::class, 'create'])->name('create');
    Route::post('/store', [JenisLaporanController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [JenisLaporanController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [JenisLaporanController::class, 'update'])->name('update');
    Route::get('/destroy/{id}', [JenisLaporanController::class, 'destroy'])->name('destroy');
});
