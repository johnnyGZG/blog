<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
	// Convertir Fechas Diferentes a Formato Carbon
    protected $dates = ['published_at'];

    // Sobrescribiendo metodo de eloquent
    protected static function boot()
    {
        // se coloca esta linea primero
        parent::boot();

        // Cuando se llame el metodo Eloquent ->delete() en el controlador ejecuta esta funcion
        // cuando se desee eliminar un post tambien eliminara las relaciones de las otras tabals involucradas
        static::deleting(function($post){

            // Elimina todos los Tags que esten relacionadas con el posts a eliminar
            // El metodo '->detach()' se encarga de ello
            $post->tags()->detach(); 

            // Forma mas abreviada para el 'each'
            $post->photos->each->delete();
        });
    }

    // Se definen los datos que solo se pueden modificar, si hay mas se ignoran
    protected $fillable = [
        'title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id'
    ];

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

    public function owner()
    {
        // Un Post Pertenece a un usuario
        return $this->belongsTo(User::class, 'user_id');
    }

    // Definicion de query scope 
    // siempre debe de iniciar con scopeNombreFuncion($query)
    public function scopePublished($query){
        $query->whereNotNull('published_at') // Verifica si es nulo o no - en caso de ser nulo omite el registro
                        ->where('published_at','<=',Carbon::now() ) // Post publicados hasta la fecha actual
                        ->latest('published_at');
    }

    public function isPublished()
    {
        // si tiene una fecha de publicacion definida y si en menor al dia actual devuelve true de lo contario false
        // today() -- devuelve el dia actual 
        return ! is_null($this->published_at) && $this->published_at < today();
    }

    // Se sobrescribe el metodo create
    public static function create(array $attributes = [])
    {
        // Devuelve el dato recien creado
        $post = static::query()->create($attributes);

        // funcion encargada de guardar el post con sus repectivas modificaciones internas
        $post->generateUrl();

        // se retorna el dato creado
        return $post;
    }

    public function generateUrl()
    {
        // Se genera la url amigable
        // Se puede acceder a cualquier dato del modelo utilizando - $this
        $url = str_slug($this->title);

        // Se encarga de verificar la existencia de un registro, -- devuelve True si hay de lo contrario False
        if($this->whereUrl($url)->exists())
        {
            // Se concatena el nombre del titulo y el id del post para que la url sea unica
            $url = "{$url}-{$this->id}";
        }
        
        $this->url = $url;

        // Se guarda el Dato
        $this->save();
    }

    // Mutador
    // Metodo que se ejecuta antes de Guardar o Modificar un Modelo
    // public function setTitleAttribute($title)
    // {
        // Valor que se quiere modificar
        // $this->attributes['title'] = $title;
        
        // $url = str_slug($title);

        // Comprobar existencia de un valor
        // $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->exists();

        // Si devuelve registros da true de lo contrario false
        // $duplicateUrlCount = Post::where('url', 'LIKE', "{$url}%")->count();
        
        // if($duplicateUrlCount)
        // {
            // Para pasar un id unico se pasa la funcion - uniqid();
            // $url .= "-" . ++$duplicateUrlCount;
        // }

        // $this->attributes['url'] = str_slug($title); // Guarda el nombre sin espacios y sin caracteres especiales
    // }

    // Mutador
    // Metodo que se ejecuta antes de Guardar o Modificar un Modelo
    public function setPublishedAtAttribute($published_at)
    {
        // Valor que se quiere modificar
       $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null; // Convierte formato fecha que se requiere;
    }

    // Mutador
    // Metodo que se ejecuta antes de Guardar o Modificar un Modelo
    public function setCategoryIdAttribute($category)
    { 
        // Valor que se quiere modificar
       $this->attributes['category_id'] = Category::find($category)
                                            ? $category
                                            : Category::create(['name' => $category])->id;
    }

    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }

    public function viewType($home = '')
    {
        if($this->photos->count() === 1):
            return 'posts.photo';
        elseif($this->photos->count() > 1):
            return $home === 'home' ? 'posts.carousel-preview' : 'posts.carousel';
        elseif($this->iframe):
            return 'posts.iframe';
        else:
            return 'posts.text';
        endif;

        // return 'posts.photo';
    }
}
