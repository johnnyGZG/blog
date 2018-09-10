<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Tag;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $this->validate($request, ['title' => 'required']);

        $post = Post::create( $request->only('title') ); // Solo trae el atributo 'title' y los demas los ignora

        // Se redirige a la vista de edicion con la informacion del post recien creado
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('categories', 'tags', 'post'));
    }

    public function update(Post $post, Request $request)
    {
        // Validacion

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category'=> 'required',
            'excerpt' => 'required',
            'tags' => 'required'
        ]);
        // return Post::create($request->all());

        // dd($request->filled('published_at'));

        // $post = new Post;
        $post->title = $request->get('title');
        // $post->url = str_slug($request->get('title')); - ya no se necesita por el mutador definido en el modelo post
        $post->body = $request->get('body');
        $post->iframe = $request->get('iframe');
        $post->excerpt = $request->get('excerpt');

        $post->published_at = $request->filled('published_at') 
                                ? Carbon::parse($request->get('published_at')) 
                                : null; // Convierte formato fecha que se requiere
        
        // Se crea una categoria si no existe
        // Si se manda un string la crea si manda un id ignora el caso
        $post->category_id = Category::find($cat = $request->get('category'))
                                ? $cat
                                : Category::create(['name' => $cat])->id;
        $post->save();

        $tags = [];
        
        // Recorre los tags y si uno de ellos no existe se crea automaticamente
        foreach($request->get('tags') as $tag)
        {
            $tags[] = Tag::find($tag)
                        ? $tag
                        : Tag::create(['name' => $tag])->id;
        }

        // etiquetas en formato Array

        // Para evitar duplicacion de datos al actualizar - sync
        // Cuando se inserta un nuevo regitro sin actualizar - attach
        // $post->tags()->sync($request->get('tags'));
        $post->tags()->sync($tags);
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada');
    }
}
