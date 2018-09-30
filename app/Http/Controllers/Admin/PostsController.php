<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index(){

    	$posts = Post::all();
    	return view('admin.posts.index', compact('posts'));
    }

    /* public function create(){

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    } */

    public function store(Request $request)
    {
        $this->validate($request, ['title' => 'required|min:3']);

        // $post = Post::create( $request->only('title') ); // Solo trae el atributo 'title' y los demas los ignora

        $post = Post::create([
            'title' => $request->get('title'),
            'user_id' => auth()->id() // devuelve el id del usurio autenticado
        ]);

        // Se redirige a la vista de edicion con la informacion del post recien creado
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Post $post, StorePostRequest $request)
    {
        // Validacion
        // La validacion se realiza automaticamente desde la clase 'StorePostRequest'
        /* $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category'=> 'required',
            'excerpt' => 'required',
            'tags' => 'required'
        ]); */
        // return Post::create($request->all());

        // dd($request->filled('published_at'));

        // $post = new Post;
        // $post->title = $request->get('title');
        // $post->url = str_slug($request->get('title')); - ya no se necesita por el mutador definido en el modelo post
        // $post->body = $request->get('body');
        // $post->iframe = $request->get('iframe');
        // $post->excerpt = $request->get('excerpt');
        // $post->published_at = $request->get('published_at');

        /*$post->published_at = $request->filled('published_at') 
                                ? Carbon::parse($request->get('published_at')) 
                                : null; // Convierte formato fecha que se requiere*/
        
        // Se crea una categoria si no existe
        // Si se manda un string la crea si manda un id ignora el caso
        /* $post->category_id = Category::find($cat = $request->get('category'))
                                ? $cat
                                : Category::create(['name' => $cat])->id;*/

        // $post->category_id = $request->get('category_id');

        // Se utiliza las propiedades de eloquent 
        // Esto se hace siempre y cuando los nombres de los campos sean iguales a los definidos en el modelo
        $post->update($request->all());

        $post->save();

        // $tags = [];
        
        // Recorre los tags y si uno de ellos no existe se crea automaticamente
        /*foreach($request->get('tags') as $tag)
        {
            $tags[] = Tag::find($tag)
                        ? $tag
                        : Tag::create(['name' => $tag])->id;
        }*/

        // Metodo del modelo para guargar array de etiquetas
        $post->syncTags($request->get('tags'));

        // etiquetas en formato Array

        // Para evitar duplicacion de datos al actualizar - sync
        // Cuando se inserta un nuevo regitro sin actualizar - attach
        // $post->tags()->sync($request->get('tags'));
        // $post->tags()->sync($tags);
        return redirect()
                ->route('admin.posts.edit', $post)
                ->with('flash', 'La publicación ha sido guardada');
    }

    // Eliminar el posts y las realciones en las diferentes tablas
    public function destroy(Post $post)
    {
        // Elimina todos los Tags que esten relacionadas con el posts a eliminar
        // El metodo '->detach()' se encarga de ello
        // $post->tags()->detach(); 

        // de esta forma se eliminaria las fotos de la base de adtos pero no del servidor
        // $post->photos()->delete();

        // de esta forma se borrarian las fotos tanto de la base de datos como del servidor
        // se debe iterar a cada foto para acceder al servidor
        /* foreach($post->photos as $photo)
        {
            $photo->delete();
        } */

        // Otra forma para recorrelo es de forma de coleccion con el metodo 'each'
        /* $post->photos->each(function($photo){
            $photo->delete();
        }); */

        // Forma mas abreviada para el 'each'
        $post->photos->each->delete();

        // Elimina la informacion del post -- ->delete() es un metodo de Eloquent
        $post->delete();

        return redirect()
                ->route('admin.posts.index')
                ->with('flash', 'La publicación ha sido eliminada');
    }
}
