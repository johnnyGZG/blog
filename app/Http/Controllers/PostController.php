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
        // Se verifica que el post tenga una fecha de publicacion
        // si no tiene fecha de publicacion que se muestre si se esta logueado con la funncion -- auth()->check()
        if($post->isPublished() || auth()->check())
        {
            // $post = Post::find($id); // Hace lo mismo que lo que se definio en los parentesis de la funcion
            return view('posts.show', compact('post'));
        }

        // asi se invocan los errores
        // Para personalizar los errores crear carpeta en - resources/views/, que se llame 'errors' 
        // dentro de la carpeta se crea el archivo de plantilla con el nombre del error a sobreescribir -- ejemplo - 404.blade.php
        abort(404);
        
    }
}
