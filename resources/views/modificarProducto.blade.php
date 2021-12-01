@extends('layouts.plantilla')

@section('contenido')


        <h1>Modificación de un producto</h1> 

        @if( $errors->any() )
            <div class="alert alert-danger col-8 mx-auto">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarProducto" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                
                Nombre: <br>
                <input type="text" name="prdNombre" class="form-control" value="{{ old('prdNombre', $Producto->prdNombre) }}">
                <br>
                Precio: <br>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="prdPrecio" class="form-control" step="0.01" value="{{ old('prdPrecio', $Producto->prdPrecio) }}"">
                </div>
                <br>
                Marca: <br>
                <select name="idMarca" class="form-control">
                    @foreach ($Marcas as $marca)
                        
                    <option {{ ( old('idMarca', $Producto->idMarca )==$marca->idMarca )?'selected':'' }} value="{{$marca->idMarca}}">{{ $marca->mkNombre }}</option>
                    
                    @endforeach
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control">
                    @foreach ($Categorias as $categoria)
                        
                    <option {{ ( old('idCategoria', $Producto->idCategoria )==$categoria->idCategoria )?'selected':'' }} value="{{ $categoria->idCategoria }}">{{ $categoria->catNombre }}</option>
                    
                    @endforeach
                </select>
                <br>
                Presentacion: <br>
                <textarea name="prdPresentacion" class="form-control" value="{{ $Producto->prdPresentacion }}"></textarea>
                <br>
                Stock: <br>
                <input type="number" name="prdStock" class="form-control" min="0" value="{{ old('prdStock', $Producto->prdStock) }}">
                <br>
                Imagen actual: <br>

                <div class="d-flex justify-content-center m-3">
                    <img src="/productos/{{ $Producto->prdImagen }}" class="img-thumbnail" alt="">
                </div>

                Modificar Imagen (opcional): <br>

                <div class="custom-file mt-1 mb-4">
                    <input type="file" name="prdImagen"  class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo: </label>
                </div>

                <input type="hidden" name="idProducto" value="{{ $Producto->idProducto }}">
                <input type="hidden" name="imgActual" value="{{ $Producto->prdImagen }}">

                <br>
                <button class="btn btn-dark mb-3">Modificar Producto</button>
                <a href="/adminProductos" class="btn btn-outline-secondary mb-3">Volver al panel de Productos</a>
            </form>

        </div>

        @if( $errors->any() )
            <div class="alert alert-danger col-8 mx-auto">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


   @endsection

