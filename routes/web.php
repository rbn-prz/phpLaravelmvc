<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});


########################################
### CRUD de Marcas


Route::get('/adminMarcas',      [ MarcaController::class, 'index' ]);
Route::get('/adminCategorias',  [ CategoriaController::class, 'index' ]);
Route::get('/adminProductos',   [ ProductoController::class, 'index' ]);
