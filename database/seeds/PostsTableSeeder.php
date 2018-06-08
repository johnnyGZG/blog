<?php

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Limpia la tabla e inserta el registro
    	Post::truncate();

    	Category::truncate();


    	$category = new Category;

    	$category->name = "Categoria 1";

    	$category->save();


		$category = new Category;

    	$category->name = "Categoria 2";

    	$category->save();


        $post = new Post;

        $post->title = "Mi Primer post";

        $post->url = str_slug("Mi Primer post");

        $post->excerpt = "Extracto de mi primer post";

        $post->body = "<p>Contenido de mi primer post</p>";

        $post->published_at = Carbon::now()->subDays(4); // Sustraer dias de la fecha actual

        $post->category_id = 1;

        $post->save();


        $post = new Post;

        $post->title = "Mi Segundo post";

        $post->url = str_slug("Mi Segundo post");

        $post->excerpt = "Extracto de mi Segundo post";

        $post->body = "<p>Contenido de mi Segundo post</p>";

        $post->published_at = Carbon::now()->subDays(3);

        $post->category_id = 1;

        $post->save();


        $post = new Post;

        $post->title = "Mi Tercer post";

        $post->url = str_slug("Mi Tercer post");

        $post->excerpt = "Extracto de mi Tercer post";

        $post->body = "<p>Contenido de mi Tercer post</p>";

        $post->published_at = Carbon::now()->subDays(2);

        $post->category_id = 2;

        $post->save();


        $post = new Post;

        $post->title = "Mi Cuarto post";

        $post->url = str_slug("Mi Cuarto post");

        $post->excerpt = "Extracto de mi Cuarto post";

        $post->body = "<p>Contenido de mi Cuarto post</p>";

        $post->published_at = Carbon::now()->subDays(1);

        $post->category_id = 2;

        $post->save();
    }
}
