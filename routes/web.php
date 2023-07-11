<?php

use App\Http\Controllers\AcionamentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DefasagemController;
use App\Http\Controllers\MovimentacoesController;
use App\Http\Controllers\LigacoesController;
use App\Http\Controllers\ClienteController;
use App\Models\Acionamento;

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


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect(route('rel.mov'));
    });

    Route::prefix('/relatorios')->name('rel.')->group(function () {
        Route::get('/def', [DefasagemController::class, 'index'])->name('def');
        Route::get('/lig', [LigacoesController::class, 'index'])->name('lig');
        Route::post('/lig', [LigacoesController::class, 'index'])->name('lig');
        Route::get('/mov', [MovimentacoesController::class, 'index'])->name('mov');
        Route::post('/mov', [MovimentacoesController::class, 'index'])->name('mov');
        Route::get('/mov/detalhado', [MovimentacoesController::class, 'detalhado'])->name('detalhado');
        Route::post('/mov/detalhado', [MovimentacoesController::class, 'detalhado'])->name('detalhado');
    });
});

Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/import-clientes', [ClienteController::class, 'import']);

Route::get('/acionamentos', [AcionamentoController::class, 'index']);
Route::post('/import-acionamentos', [AcionamentoController::class, 'import']);

Route::get('/ligacoes', [LigacoesController::class, 'indexImport']);
Route::post('/import-ligacoes', [LigacoesController::class, 'import']);

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

Auth::routes();
