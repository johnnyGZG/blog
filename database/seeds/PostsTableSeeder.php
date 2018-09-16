<?php

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cuando se ejecute el --seed se eliminara la carpeta ubicada en el disco 'public' configuracion ubicada en 'config/filesystem.php'
        // no olvidar importar -- use Illuminate\Support\Facades\Storage;
        Storage::disk('public')->deleteDirectory('posts');

    	// Limpia la tabla e inserta el registro
    	Post::truncate();

        Category::truncate();
        
        Tag::truncate();


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

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));


        $post = new Post;

        $post->title = "Mi Segundo post";

        $post->url = str_slug("Mi Segundo post");

        $post->excerpt = "Extracto de mi Segundo post";

        $post->body = "<p>Contenido de mi Segundo post</p>";

        $post->published_at = Carbon::now()->subDays(3);

        $post->category_id = 1;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));


        $post = new Post;

        $post->title = "Mi Tercer post";

        $post->url = str_slug("Mi Tercer post");

        $post->excerpt = "Extracto de mi Tercer post";

        $post->body = "<p>Contenido de mi Tercer post</p>";

        $post->published_at = Carbon::now()->subDays(2);

        $post->category_id = 2;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));


        $post = new Post;

        $post->title = "Mi Cuarto post";

        $post->url = str_slug("Mi Cuarto post");

        $post->excerpt = "Extracto de mi Cuarto post";

        $post->body = "<p>Contenido de mi Cuarto post</p>";

        $post->published_at = Carbon::now()->subDays(1);

        $post->category_id = 2;

        $post->save();

        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));
    }
}
