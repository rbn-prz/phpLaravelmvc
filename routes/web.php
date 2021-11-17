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

Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);
Route::get('/agregarMarca', [ MarcaController::class, 'create']);
Route::post('/agregarMarca', [ MarcaController::class, 'store']);
Route::get('/modificarMarca/{id}', [MarcaController::class, 'edit']);
Route::patch('/modificarMarca', [MarcaController::class, 'update']);
Route::get('/eliminarMarca/{id}', [MarcaController::class, 'confirmarBaja']);

########################################
### CRUD de Categorias

Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);

########################################
### CRUD de Productos

Route::get('/adminProductos', [ ProductoController::class, 'index' ]);
