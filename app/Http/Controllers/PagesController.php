<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PagesController extends Controller
{
    public function home(){
        // Asi se realiza una query scope desde el modelo
        // Sirve para listar resultados que siempre van a ser iguales
        $posts = Post::Published()->paginate();
        
    	return view('pages.home', compact('posts'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        return view('pages.archive');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
