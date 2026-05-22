<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');


Route::middleware('auth:sanctum')->group(function () {


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
        Route::put('/{id}', [PedidoController::class, 'update'])->middleware('pedido.owner');
        Route::delete('/{id}', [PedidoController::class, 'destroy'])->middleware('pedido.owner');
    });

    Route::prefix('itens-pedido')->group(function () {
        Route::get('/', [ItemPedidoController::class, 'index']);
        Route::post('/', [ItemPedidoController::class, 'store']);
        Route::get('/{id}', [ItemPedidoController::class, 'show']);
        Route::put('/{id}', [ItemPedidoController::class, 'update']);
        Route::delete('/{id}', [ItemPedidoController::class, 'destroy']);
    });
});
