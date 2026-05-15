<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\PedidoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutosController::class, 'index']);
    Route::post('/', [ProdutosController::class, 'store']);
    Route::get('/{id}', [ProdutosController::class, 'show']);
    Route::put('/{id}', [ProdutosController::class, 'update']);
    Route::delete('/{id}', [ProdutosController::class, 'destroy']);
});

Route::prefix('pedidos')->group(function () {
    Route::get('/', [PedidoController::class, 'index']);
    Route::post('/', [PedidoController::class, 'store']);
    Route::get('/{id}', [PedidoController::class, 'show']);
    Route::put('/{id}', [PedidoController::class, 'update']);
    Route::delete('/{id}', [PedidoController::class, 'destroy']);
});

Route::prefix('itens-pedido')->group(function () {
    Route::get('/', [ItemPedidoController::class, 'index']);
    Route::post('/', [ItemPedidoController::class, 'store']);
    Route::get('/{id}', [ItemPedidoController::class, 'show']);
    Route::put('/{id}', [ItemPedidoController::class, 'update']);
    Route::delete('/{id}', [ItemPedidoController::class, 'destroy']);
});
