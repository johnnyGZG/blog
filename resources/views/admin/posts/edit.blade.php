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
    
        @if($post->photos->count())
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        @foreach($post->photos as $photo)
                            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="position: absolute;">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <img class="img-responsive" src="{{ $photo->url }}" />
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.posts.update', $post) }}">
            @csrf
            @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Titulo de la publicación</label>
                            <input  type="text" 
                                    name="title"
                                    value="{{ old('title', $post->title) }}" 
                                    class="form-control" 
                                    placeholder="Ingrese aqui el titulo de la publicación" />
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Descripción de la publicación</label>
                            <textarea id="editor" rows="10" name="body" class="form-control" placeholder="Ingrese aqui la descripción de la publicación">{{ old('body', $post->body) }}</textarea>
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
                                        value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null ) }}" 
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
                                            {{ old('category', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                                    <option {{ collect(old('tags', $post->tags->pluck('id') ))->contains($tag->id) ? 'selected' : '' }}
                                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                            <label>Extracto publicación</label>
                            <textarea name="excerpt" class="form-control" placeholder="Ingrese aqui el extracto de la publicación">{{ old('excerpt', $post->excerpt) }}</textarea>
                            {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <div class="dropzone"></div>
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

    <!-- Dropzone -->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')

    <!-- Dropzone -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
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

        // http://www.dropzonejs.com/#configuration-options - Opciones de configuracion
        var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/posts/{{ $post->url }}/photos',
            acceptedFiles: 'image/*', // Para que Dropzone solo acepte imagenes
            maxFilesize: 2, // Para definir tamaño maximo del archivo
            paramName: 'photo',
            maxFiles: 20, // limitar el numero de images asubir
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastre las fotos aqui para subirlas'
        });
        
        // mostrar errores del servidor
        myDropzone.on('error', function(file, res){
            var msg = res.errors.photo[0];
            $('.dz-error-message:last > span').html(msg);
        });

        Dropzone.autoDiscover = false;
                
    </script>
@endpush