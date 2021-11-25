<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
