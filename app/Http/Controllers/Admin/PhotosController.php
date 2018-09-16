<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Post;
use App\Photo;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'required|image|max:2048' // jpeg, png, bmp, gif, svg
        ]);
        
        // Guarda el archivo en la carpeta storage y dentro del parentecis se especifica la ruta (Si no existe la crea automaticamente)
        // Se debe ejecutar el comando ' php artisan storage:link ' - para poder acceder a las imagenes guardadas en la carpeta
        // $photoUrl =  request()->file('photo')->store('public');

        
        // $photoUrl = $photo->store('public');

        // return Storage::url($photoUrl);

       /*  Photo::create([
            'url' => 'storage/' . request()->file('photo')->store('posts','public'), // parauardar las imagenes en subcarpetas se define el primer parametro que es el nombre de la carpeta donde se va a guardar, el segundo parametro es donde se va a crear la subcarpeta
            'post_id' => $post->id
        ]); */

        // Si se crea de esta forma no es necesario implementar el campo 'post_id', ya que la relacion esta definida en el modelo
        $post->photos()->create([
            // parauardar las imagenes en subcarpetas se define el primer parametro que es el nombre de la carpeta donde se va a guardar, el segundo parametro es el nombre del disco -- en config/filesystems.php
            'url' => 'storage/' . request()->file('photo')->store('posts','public'), 
        ]);
    }

    public function destroy(Photo $photo)
    {
        // Elimina registro de la imagen de la base de datos
        // Ahora el archivo quese vaya a eliminar tambien la elimina del servidor
        $photo->delete();

        // se reemplaza el 'storage/' ya que al intentar eliminar el archivo en el servidor no la encuentra
        // $photoPath = str_replace('storage/', '', $photo->url);

        // Elimina la imagen del servidor
        // Storage::delete($photoPath);

        // Se indica que disco va a utilizar para ir a buscar la imagen para eliminarla - el archivo esta en config/filesystems.php

        // Storage::disk('public')->delete($photoPath);

        return back()->with('flash', 'Foto eliminada');
    }
}
