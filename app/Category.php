<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Al definir este metodo se esta sobreescribiendo el metodo de eloquent de laravel
    // Esta funcion en el modelo, sirve para cambiar el parametro de busqueda de los datos
    // por defecto laravel busca por id, pero con este metodo se puede encontrar un post por el nombre
    // tambien en la url ya no saldria la id del post sino el nombre del post
    public function getRouteKeyName()
    {
        // Campo por el que se quiere encontar el dato del modelo
        return 'name';
    }

    public function posts()
    {
        // Una Categoria tiene muchos Posts
        return $this->hasMany(Post::class);
    }
}
