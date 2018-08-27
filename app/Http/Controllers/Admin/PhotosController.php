<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $photoUrl =  request()->file('photo')->store('public');

        
        // $photoUrl = $photo->store('public');

        // return Storage::url($photoUrl);

        Photo::create([
            'url' => Storage::url($photoUrl),
            'post_id' => $post->id
        ]);
    }

    public function destroy(Photo $photo)
    {
        // Elimina registro de la imagen de la base de datos
        $photo->delete();

        $photoPath = str_replace('storage', 'public', $photo->url);

        // Elimina la imagen del servidor
        Storage::delete($photoPath);

        return back()->with('flash', 'Foto eliminada');
    }
}
