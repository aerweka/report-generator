<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/edit/{id}', [LaporanController::class, 'edit'])->name('show');
    Route::post('/update', [LaporanController::class, 'update'])->name('update');
});
