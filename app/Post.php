<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
	// Convertir Fechas Diferentes a Formato Carbon
    protected $dates = ['published_at'];

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

    public function category()
    {
    	// Un Post Pertenese a Una Categoria
    	return $this->belongsTo(Category::class);
    }

    public function tags()
    {
    	// Un Post Posee varios Tags
    	return $this->belongsToMany(Tag::class);
    }

    public function photos()
    {
        // Un Post Posee Varias imagenes
        return $this->hasMany(Photo::class);
    }

    // Definicion de query scope 
    // siempre debe de iniciar con scopeNombreFuncion($query)
    public function scopePublished($query){
        $query->whereNotNull('published_at') // Verifica si es nulo o no - en caso de ser nulo omite el registro
                        ->where('published_at','<=',Carbon::now() ) // Post publicados hasta la fecha actual
                        ->latest('published_at');
    }

    // Mutador
    // Metodo que se ejecuta antes de Guardar o Modificar un Modelo
    public function setTitleAttribute($title)
    {
        // Valor que se quiere modificar
       $this->attributes['title'] = $title;

       $this->attributes['url'] = str_slug($title); // Guarda el nombre sin espacios y sin caracteres especiales
    }
}
