<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    // models buildings
    // Se pasa el modelo en los parametros de la funcion y busca el post de un id especifico
    // En donde se definen las rutas se debe de colocar el mismo nombre de variable
    public function show(Post $post)
    {
        // $post = Post::find($id); // Hace lo mismo que lo que se definio en los parentesis de la funcion
        return view('posts.show', compact('post'));
    }
}
