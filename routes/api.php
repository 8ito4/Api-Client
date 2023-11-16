<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); 

    // Rotas dos clientes
    Route::post('/clientes', [ClienteController::class, 'criarNovoCliente']);
    Route::get('/clientes/{id}', [ClienteController::class, 'buscarClientePorID']);
    Route::put('/clientes/{id}', [ClienteController::class, 'editarCliente']);
    Route::delete('/clientes/{id}', [ClienteController::class, 'excluirCliente']);
});

