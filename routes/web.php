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
# Admin
Route::get('/adminMarcas', [ MarcaController::class, 'index' ]);
# Agregar
Route::get('/agregarMarca', [ MarcaController::class, 'create']);
Route::post('/agregarMarca', [ MarcaController::class, 'store']);
# Modificar
Route::get('/modificarMarca/{id}', [ MarcaController::class, 'edit'] );
Route::patch('/modificarMarca', [ MarcaController::class, 'update'] );
# Eliminar
Route::get('/eliminarMarca/{id}', [ MarcaController::class, 'confirmarBaja'] );
Route::delete('/eliminarMarca', [ MarcaController::class, 'destroy' ]);

########################################
### CRUD de Categorias
# Admin
Route::get('/adminCategorias', [ CategoriaController::class, 'index' ]);
# Agregar
Route::get('/agregarCategoria', [ CategoriaController::class, 'create' ]);
Route::post('/agregarCategoria', [ CategoriaController::class, 'store' ]);
# Modificar
Route::get('/modificarCategoria/{id}', [CategoriaController::class, 'edit' ]);
Route::patch('modificarCategoria', [ CategoriaController::class, 'update' ]);
# Eliminar
Route::get('/eliminarCategoria/{id}', [ CategoriaController::class, 'confirmarBaja' ]);
Route::delete('/eliminarCategoria', [CategoriaController::class, 'destroy'] );

########################################
### CRUD de Productos
# Admin
Route::get('/adminProductos', [ ProductoController::class, 'index' ]);
# Agregar
Route::get('/agregarProducto', [ ProductoController::class, 'create' ]);
Route::post('/agregarProducto', [ ProductoController::class, 'store' ]);
# Modificar
Route::get('/modificarProducto/{id}', [ ProductoController::class, 'edit' ]);
Route::patch('/modificarProducto', [ ProductoController::class, 'update' ]);
# Eliminar
Route::get('/eliminarProducto/{id}', [ ProductoController::class, 'confirmarBaja' ]);
Route::delete('/eliminarProducto', [ ProductoController::class, 'destroy' ]);


