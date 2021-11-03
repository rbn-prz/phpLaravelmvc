<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});


########################################
### CRUD de Marcas


Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);
