<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    #### Metodos de relacion

    public function getMarca()
    {
        
        ### Metodo de relacion para que laravel escriba el join
        return $this->belongsTo(
            Marca::class,
            'idMarca',
            'idMarca'
        );
    }

    public function getCategoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'idCategoria',
            'idCategoria'
        );
    }

}
