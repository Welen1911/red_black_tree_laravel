<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'getProdutos']);
    Route::get('/array', [ProdutoController::class, 'getProdutosArray']);
});
