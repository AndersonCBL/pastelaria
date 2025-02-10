<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductTypeController;

// Rotas para o módulo Cliente
Route::apiResource('customers', CustomerController::class);

// Rotas para o módulo Produto
Route::apiResource('products', ProductController::class);

// Rotas para o módulo Pedido
Route::apiResource('orders', OrderController::class);

// Rota para listar tipos de produtos
Route::get('product_types', [ProductTypeController::class, 'index']);
