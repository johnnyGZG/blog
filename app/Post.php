<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
	// Convertir Fechas Diferentes a Formato Carbon
    protected $dates = ['published_at'];

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

    // Definicion de query scope 
    // siempre debe de iniciar con scopeNombreFuncion($query)
    public function scopePublished($query){
        $query->whereNotNull('published_at') // Verifica si es nulo o no - en caso de ser nulo omite el registro
                        ->where('published_at','<=',Carbon::now() ) // Post publicados hasta la fecha actual
                        ->latest('published_at');
    }
}
