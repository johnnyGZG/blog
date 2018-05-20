<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
