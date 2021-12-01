<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Listamos los procutos
        /* 
        $productos = DB::table('productos')
                                    ->join('marcas', 'productos.idMarca', '=', 'marcas.idMarca')
                                    ->join('categorias', 'productos.idCategoria', '=', 'categorias.idCategoria')
                                    ->get(); 
        */

        $productos = Producto::with(['getMarca', 'getCategoria'])->paginate(6);
        return view('adminProductos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtenemos listado de marcas
        $marcas = Marca::all();
        //obtenemos listado de categorias
        $categorias = Categoria::all();
        //Devolver vista
        return view('agregarProducto', [ 'marcas' => $marcas, 'categorias' => $categorias ]);
    }


    private function validarForm(Request $request)
    {
        $request->validate(
            [
                'prdNombre'=>'required|min:2|max:30',
                'prdPrecio'=>'required|numeric|min:0',
                'idMarca'=>'required',
                'idCategoria'=>'required',
                'prdPresentacion'=>'required|min:3|max:150',
                'prdStock'=>'required|integer|min:1',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
            ],
            [
                'prdNombre.required'=>'El campo "Nombre del producto" es obligatorio.',
                'prdNombre.min'=>'El campo "Nombre del producto" debe tener como mínimo 2 caractéres.',
                'prdNombre.max'=>'El campo "Nombre" debe tener 30 caractéres como máximo.',
                'prdPrecio.required'=>'Complete el campo Precio.',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número.',
                'prdPrecio.min'=>'Complete el campo Precio con un número positivo.',
                'idMarca.required'=>'Seleccione una marca.',
                'idCategoria.required'=>'Seleccione una categoría.',
                'prdPresentacion.required'=>'Complete el campo Presentación.',
                'prdPresentacion.min'=>'Complete el campo Presentación con al menos 3 caractéres',
                'prdPresentacion.max'=>'Complete el campo Presentación con 150 caractérescomo máxino.',
                'prdStock.required'=>'Complete el campo Stock.',
                'prdStock.integer'=>'Complete el campo Stock con un número entero.',
                'prdStock.min'=>'Complete el campo Stock con un número positivo.',
                'prdImagen.mimes'=>'Debe ser una imagen.',
                'prdImagen.max'=>'Debe ser una imagen de 2MB como máximo.'
            ]
        );
    }

    private function subirImagen(Request $request)
    {
        //si no enviaron imagen en Store
        $prdImagen = 'noDisponible.jpg';

        //Si no enviaron imagen en Update
        if( $request->has('imgActual') ){
            $prdImagen = $request->imgActual;
        }
        
        //Si enviaron imagen
        if( $request->file('prdImagen') ){
           //renombrar archivo
            //time() . extension
            $extension = $request->file('prdImagen')->extension();
            $prdImagen = time().'.'.$extension;
            #subir archivo
            $request->file('prdImagen')->move(public_path('productos/'), $prdImagen);
        }

        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar
        $this->validarForm($request);
        //Subir Imagen 
        $prdImagen = $this->subirImagen($request);
        //instanciar, asignar atributos , guardar
        $Producto = new Producto();
        $Producto->prdNombre        = $request->prdNombre;
        $Producto->prdPrecio        = $request->prdPrecio;
        $Producto->idMarca          = $request->idMarca;
        $Producto->idCategoria      = $request->idCategoria;
        $Producto->prdPresentacion  = $request->prdPresentacion;
        $Producto->prdStock         = $request->prdStock;
        $Producto->prdImagen        = $prdImagen;
        $Producto->save();        
        //retornar redireccion con mensaje ok
        return redirect('adminProductos')->with([ 'mensaje'=>'Producto: '.$Producto->prdNombre.' agregado correctamente.' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Obtenemos datos de un prodcuto
        $Producto = Producto::find($id);
        //obtenemos listado de marcas y de categorias
        $Marcas = Marca::all();
        $Categorias = Categoria::all();
        //retornar la vista del form
        return view('modificarProducto', [ 'Producto'=>$Producto, 'Marcas'=>$Marcas, 'Categorias'=>$Categorias ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validar
        $this->validarForm($request);
        //subirimagen *
        $prdImagen = $this->subirImagen($request);
        //obtenemos datos de producto
        $Producto = Producto::find($request->idProducto);
        //Asignacion y save
        $Producto->prdNombre        = $request->prdNombre;
        $Producto->prdPrecio        = $request->prdPrecio;
        $Producto->idMarca          = $request->idMarca;
        $Producto->idCategoria      = $request->idCategoria;
        $Producto->prdPresentacion  = $request->prdPresentacion;
        $Producto->prdStock         = $request->prdStock;
        $Producto->prdImagen        = $prdImagen;
        $Producto->save();        
        //redireccion con mensaje ok
        return redirect('adminProductos')->with([ 'mensaje'=>'Producto: '.$Producto->prdNombre.' modificado correctamente.' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
