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

                        <!-- Date -->
                        <div class="form-group">
                            <label>Date:</label>
                
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group">
                            <label>Categorias</label>
                            <select name="body" class="form-control" >
                                <option vakue="">Selecione una categoria</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Extracto publicación</label>
                            <textarea rows="6" name="excerpt" class="form-control" placeholder="Ingrese aqui el extracto de la publicación"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endpush

@push('scripts')

    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminLTE/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });
    </script>
@endpush