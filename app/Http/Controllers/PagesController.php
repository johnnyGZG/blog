<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PagesController extends Controller
{
    public function home(){
        // Asi se realiza una query scope desde el modelo
        // Sirve para lister resultados que siempre van a ser iguales
        $posts = Post::Published()->paginate();
        
    	return view('welcome', compact('posts'));
    }
}
