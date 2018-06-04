@extends('admin.layout')

@section('header')

<section class="content-header">

	<h1>
    	Posts
    	<small>Crear nueva publicación</small>
  	</h1>
  	<ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-list"></i> Posts</a></li>
    	<li class="active">Crear</li>
  	</ol>

 @endsection

@section('content')

    <div class="row">
        <form>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Titulo de la publicación</label>
                            <input type="text" name="title" class="form-control" placeholder="Ingrese aqui el titulo de la publicación" />
                        </div>

                        <div class="form-group">
                            <label>Descripción de la publicación</label>
                            <textarea rows="10" name="body" class="form-control" placeholder="Ingrese aqui la descripción de la publicación"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Extracto publicación</label>
                            <input type="date" name="published_at" class="form-control" />
                        </div>

                        <div class="form-group">
                            <label>Extracto publicación</label>
                            <textarea rows="10" name="excerpt" class="form-control" placeholder="Ingrese aqui el extracto de la publicación"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection