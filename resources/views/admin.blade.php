@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <div class="list-group">
            <a href="/adminMarcas" class="list-group-item list-group-item-action">
                Panel de administración de marcas.
            </a>
            <a href="/adminCategorias" class="list-group-item list-group-item-action">
                Panel de administración de categorias.
            </a>
            <a href="/adminProductos" class="list-group-item list-group-item-action">
                Panel de administración de productos.
            </a>

        
        </div>

    @endsection
