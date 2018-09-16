<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    // Desabilitar almacenamiento masivo - ya que se esta siendo especifico con los campos
    protected $guarded = [];

    // Sobrescribiendo metodo de eloquent
    protected static function boot()
    {
        // se coloca esta linea primero
        parent::boot();

        // Cuando se llame el metodo Eloquent ->delete() en el controlador ejecuta esta funcion
        // se encarga de eliminar el archivo del servidor
        // no olvidar importar -- use Illuminate\Support\Facades\Storage;
        static::deleting(function($photo){
            $photoPath = str_replace('storage/', '', $photo->url);
            Storage::disk('public')->delete($photoPath);
        });
    }
}
