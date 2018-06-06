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
        <form method="POST" action="{{ route('admin.posts.store') }}">
            @csrf
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Titulo de la publicación</label>
                            <input  type="text" 
                                    name="title"
                                    value="{{ old('title') }}" 
                                    class="form-control" 
                                    placeholder="Ingrese aqui el titulo de la publicación" />
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Descripción de la publicación</label>
                            <textarea id="editor" rows="10" name="body" class="form-control" placeholder="Ingrese aqui la descripción de la publicación">{{ old('body') }} </textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
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
                                <input  type="text" 
                                        name="published_at" 
                                        value="{{ old('published_at') }}" 
                                        class="form-control pull-right" 
                                        id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label>Categorias</label>
                            <select name="category" class="form-control" >
                                <option vakue="">Selecione una categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                            <label>Etiquetas</label>
                            <select name="tags[]" class="form-control select2" 
                                    multiple="multiple" 
                                    data-placeholder="Seleccione una o mas etiquetas"
                                    style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}
                                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label>Extracto publicación</label>
                            <textarea name="excerpt" class="form-control" placeholder="Ingrese aqui el extracto de la publicación">{{ old('excerpt') }}</textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar publicación</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.1/classic/ckeditor.js"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminLTE/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminLTE/plugins/select2/dist/js/select2.full.min.js') }}"></script>

    <script>
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });

        //Initialize Select2 Elements
        $('.select2').select2()
        
        ClassicEditor
			.create( document.querySelector( '#editor' ) )
			.then( editor => {
				console.log( editor );
			} )
			.catch( error => {
				console.error( error );
            } );
                
    </script>
@endpush