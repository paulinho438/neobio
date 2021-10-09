<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

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

Route::get('/', [HomeController::class, 'index']);

Route::post('/produto/add', [ProdutoController::class, 'add']);
Route::post('/produto/edit', [ProdutoController::class, 'edit']);
Route::post('/produto/delete', [ProdutoController::class, 'delete']);

Route::post('/categoria/add', [ProdutoController::class, 'add']);
Route::post('/categoria/edit', [ProdutoController::class, 'edit']);

Route::post('/cliente/add', [ProdutoController::class, 'clienteAdd']);
Route::post('/cliente/edit', [ProdutoController::class, 'clienteEdit']);

Route::get('/allprodutos', [ProdutoController::class, 'allProdutos']);

