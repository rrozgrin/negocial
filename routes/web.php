<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DefasagemController;
use App\Http\Controllers\MovimentacoesController;

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
    return redirect(route('rel.mov'));
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

Route::prefix('/relatorios')->name('rel.')->group(function () {
    Route::get('/def', [DefasagemController::class, 'index'])->name('def');
    Route::get('/lig', function(){ return view('relatorios.ligacoes.index');})->name('lig');
    Route::get('/mov', [MovimentacoesController::class, 'index'])->name('mov');
    Route::post('/movdata', [MovimentacoesController::class, 'indexdata'])->name('movdata');
    Route::get('/mov/individual', [MovimentacoesController::class, 'individual'])->name('individual');
    Route::post('/mov/individualselecionado', [MovimentacoesController::class, 'individualselecionado'])->name('individualselecionado');
    
});

Auth::routes();
