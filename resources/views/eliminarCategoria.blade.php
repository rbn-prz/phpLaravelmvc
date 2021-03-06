@extends('layouts.plantilla')

    @section('contenido')

        <h1>Baja de una categoria</h1>

        <div class="alert alert-danger col-6 mx-auto p-4">

            Se eliminará la categoria:
            <span class="lead">
                {{ $Categoria->mkNombre }}
            </span>
            <form action="/eliminarCategoria" method="post">
                
            @method('delete')
            @csrf

                <input type="hidden" name="catNombre" value="{{ $Categoria->catNombre }}">
                <input type="hidden" name="idCategoria" value="{{ $Categoria->idCategoria }}">

                <button class="btn btn-danger btn-block my-3">
                    Confirmar baja
                </button>
                <a href="/adminCategorias" class="btn btn-light btn-block">
                    volver a panel
                </a>
            </form>
        </div>


        <script>
            Swal.fire(
                'Advertencia!',
                'Su pulsa el botón "Confirmar baja", se eliminará la Categoria seleccionada',
                'warning'
            );
        </script>


    @endsection
