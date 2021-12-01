<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    //Deshabilitar timestamps
    public $timestamps = false;

    protected $primaryKey = 'idProducto';

    #### Metodos de relacion

    # Metodo de relacion de Marca
    public function getMarca()
    {

        ### Metodo de relacion para que laravel escriba el join
        ### Metodos:
        //$this->hasOne();  //muchos a uno
        //$this->hasMany(); //tiene muchos

        return $this->belongsTo(
            Marca::class,
            'idMarca',
            'idMarca'
        );
    }

    # Metodo de relacion de Categoria
    public function getCategoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'idCategoria',
            'idCategoria'
        );
    }

}
