<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Devuelve los posts relacionados a la categoria
    public function show(Category $category)
    {
        // Carga solo solo los datos de la realcion
        // return $category->load("posts");

        $posts = $category->posts()->paginate();
        $title = "Publicaciones de la etiqueta {$category->name}";

        return View("pages.home", compact("posts","title"));
    }
}
