<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\TransacaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('conta')->group(function () {
    Route::controller(ContaController::class)->group(function () {
        Route::post('/', 'criar')->name('conta.criar');
        Route::get('/', 'visualizar')->name('conta.visualizar');
    });
});

Route::prefix('transacao')->group(function () {
    Route::controller(TransacaoController::class)->group(function () {
        Route::post('/', 'pagamento')->name('transacao.pagamento');
    });
});




