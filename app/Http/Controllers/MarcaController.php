<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //obtenemos Lista de marcas
        //$marcas = Marca::all();
        //$marcas = Marca::simplePaginate(5);
        $marcas = Marca::Paginate(5);
        return view('adminMarcas', ['marcas'=>$marcas]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostrar el formulario
        return view('agregarMarca');
    }

    private function validarForm($request)
    {
        $request->validate(
            [ 'mkNombre'=>'required|min:2|max:50' ],
            [ 
                'mkNombre.required' => 'El campo nombre de la marca es obligatorio.',
                'mkNombre.min' => 'El campo nombre de la marca debe tener al menos 2 caracteres.',
                'mkNombre.max' => 'El campo nombre de la marca debe tener 50 caracteres como maximo.'
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
        // Guardar el recuros (como un insert)

        //capturamos el dato del formulario 
        $mkNomre = $request->mkNombre;

        //validamos
        $this->validarForm($request);
        
        //magia
        // Instanciamos, asignamos, guardamos
        $Marca = new Marca();
        $Marca->mkNombre = $mkNomre;
        $Marca->save();

        //redireccion + mensaje de ok
        return redirect('/adminMarcas')->with(['mensaje' => 'Marca '.$mkNomre.' Agregada correctamente.']);
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
