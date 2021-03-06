<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // Desactiva el almacenamiento masivo -- se utiliza cuando los datos bienen como un array
    protected $guarded = [];

    // Al definir este metodo se esta sobreescribiendo el metodo de eloquent de laravel
    // Esta funcion en el modelo, sirve para cambiar el parametro de busqueda de los datos
    // por defecto laravel busca por id, pero con este metodo se puede encontrar un post por el nombre
    // tambien en la url ya no saldria la id del post sino el nombre del post
    public function getRouteKeyName()
    {
        // Campo por el que se quiere encontar el dato del modelo
        return 'url';
    }

    public function posts()
    {
        // Una Etiqueta tiene muchos Posts
        return $this->belongsToMany(Post::class);
    }

    // Mutador
    // Metodo que se ejecuta antes de Guardar o Modificar un Modelo
    public function setNameAttribute($name)
    {
        // Valor que se quiere modificar
       $this->attributes['name'] = $name;

       $this->attributes['url'] = str_slug($name); // Guarda el nombre sin espacios y sin caracteres especiales
    }
}
