<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/clientes', [ClienteController::class, 'criarNovoCliente']);
Route::get('/clientes/{id}', [ClienteController::class, 'buscarClientePorID']);
Route::put('/clientes/{id}', [ClienteController::class, 'editarCliente']);
Route::delete('/clientes/{id}', [ClienteController::class, 'excluirCliente']);

