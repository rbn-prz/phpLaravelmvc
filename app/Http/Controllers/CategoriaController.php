<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos los datos
        $categorias = Categoria::all();
        return view('adminCategorias', ['categorias'=>$categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Retornamos la vista de categoria
        return view('agregarCategoria');
    }

    private function validarForm($request)
    {
        $request->validate(
            [ 'catNombre'=>'required|min:2|max:50' ],
            [ 
                'catNombre.required' => 'El campo nombre de la categoria es obligatorio.',
                'catNombre.min' => 'El campo nombre de la categoria debe tener al menos 2 caracteres.',
                'catNombre.max' => 'El campo nombre de la categoria debe tener 50 caracteres como maximo.'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //capturamos Dato
        $catNombre = $request->catNombre;
        //Validamos
        $this->validarForm($request);
        //magia
        //Instanciamos; asignamos, guardamos
        $Categoria = new Categoria();
        $Categoria->catNombre = $catNombre;
        $Categoria->save();
        //Retornamos con redireccion / Flashing
        return redirect('/adminCategorias')->with(['mensaje'=> 'Categoria '.$catNombre.' agregada correctamente']);

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
        //Obtenemos la Categoria
        $Categoria = Categoria::find($id);
        //Retornamos
        return view('modificarCategoria',[ 'Categoria'=>$Categoria ]);
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
        $catNombre = $request->catNombre;
        //validacion
        $this->validarForm($request);
        //Obtenemos datos de la cat
        $Categoria = Categoria::find($request->idCategoria);        
        //Asignar y guardar
        $Categoria->catNombre = $catNombre;
        $Categoria->save();
        //retornamos redirec con msj OK
        return redirect('/adminCategorias')->with(['mensaje'=>'Categoria '.$catNombre.' modificada correctamente']);
    }

    private function productoPorCategoria($idCateogoria)
    {
        $check = Producto::firstWhere('idCategoria', $idCateogoria);
        return $check;
    }

    public function confirmarBaja($id) 
    {
        //Obtenemos los datos de la categoria
        $Categoria = Categoria::find($id);
        //Si no hay productos de esa categoria
        $aux = $this->productoPorCategoria($id);

        //Si no hay productos retornamos lista de confirmacion
        if(!$aux){
            return view('eliminarCategoria', [ 'Categoria' => $Categoria ]);
        }
        return redirect('/adminCategorias')->with([ 'mensaje'=>'No se puede elimnar la categoria '.$Categoria->catNmobre.' por que tiene productos asociados' ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Elimino en un paso
        Categoria::destroy($request->idcategoria);
        return redirect('/adminCategorias')->with( ['mensaje' => 'Categoria  '.$request->catNombre.' eliminada correctamente'] );
    }
}
