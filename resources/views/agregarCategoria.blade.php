@extends('layouts.plantilla')

    @section('contenido')
    
    <h1>Alta de una Categoria</h1>
    
    @if ( $errors->any() )
    <div class="alert alert-danger col-8 mx-auto">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarCategoria" method="post">
                <!-- Tokken -->
                @csrf

                <div class="form-group">
                    <label for="catNombre">Nombre de la categoria</label>
                    <input type="text" name="catNombre" class="form-control" id="catNombre" value="{{ old('catNombre') }}">
                </div>
                <button class="btn btn-dark mr-3">Agregar marca</button>
                <a href="/adminCategorias" class="btn btn-outline-secondary">
                    Volver a panel
                </a>
            </form>
        </div>




    @endsection

