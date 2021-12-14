<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
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
        // Guardar el recurso (como un insert)

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
        return redirect('/adminMarcas')->with(['mensaje' => 'Marca '.$mkNomre.' agregada correctamente.']);
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
        //obtenemos datos de marca
        $Marca = Marca::find($id);
        //retornamo vista de form con datos
        return view('modificarMarca', [ 'Marca'=>$Marca ]);

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
        $mkNombre = $request->mkNombre;
        //Validacion
        $this->validarForm($request);
        //obtnemos datos de la marca
        $Marca = Marca::find($request->idMarca);
        //Asignacon y guardar
        $Marca->mkNombre = $mkNombre;
        $Marca->save();
        //retornar redireccion con mensaje OK
        return redirect('/adminMarcas')->with(['mensaje' => 'Marca '.$mkNombre.' Modificada   correctamente.']);
    }

    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->count();
        //$check = Producto::where('idMarca', $idMarca)->first();
        $check = Producto::firstWhere('idMarca', $idMarca);
        return $check;
    }

    public function confirmarBaja($id)
    {
        //Obtenemos datos de una marca
        $Marca = Marca::find($id);
        //Si no hay productos de esa marca
        $aux = $this->productoPorMarca($id);
        //dd($aux); //onda un var_dump

        //Si no hay productos retornamos lista de confirmacion 
        if ( !$aux ) {
            return view('eliminarMarca', [ 'Marca' => $Marca ]);  
        }
        //Redireccion con mensaje que no se puede borrar
        return redirect('/adminMarcas')->with([ 'mensaje'=>'No se puede eliminar la marca: '.$Marca->mkNombre.' ya que tiene productos relacionados.' ]);
        
    }

    /**

     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Aca eliminamos, es el delete de la DB
        /**
         * Se puede hacer en dos pasos
         * $Marca =  Marca::find($request->idMarca);
         * $Marca->delete();
         */
        Marca::destroy($request->idMarca);
        return redirect('/adminMarcas')->with(['mensaje' => 'Marca '.$request->mkNomre.' eliminada correctamente.']);

    }
}
