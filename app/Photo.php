<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    // Desabilitar almacenamiento macivo - ya que se esta siendo especifico con los campos
    protected $guarded = [];
}
