@extends('admin.layout')

@section('header')

<section class="content-header">

	<h1>
    	Todas las publicaciones
    	<small></small>
  	</h1>
  	<ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    	<li class="active">Posts</li>
  	</ol>

 @endsection

@section('content')

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Data Table With Full Features</h3>
			<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
				<i class="fa fa-plus"></i>
				Crear publicación
			</button>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="posts-table" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>ID</th>
					<th>Titulo</th>
					<th>Extracto</th>
					<th>Acciones</th>
				</tr>
				</thead>
				<tbody>
					@foreach($posts as $post)
		<tr>
			<td>{{ $post->id }}</td>
			<td>{{ $post->title }}</td>
			<td>{{ $post->excerpt }}</td>
			<td>
				<a href="#" class="btn btn-xs btn-info">
					<i class="fa fa-pencil"></i>
				</a>
				<a href="#" class="btn btn-xs btn-danger">
					<i class="fa fa-times"></i>
				</a>
			</td>
		</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
	
	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<form method="POST" action="{{ route('admin.posts.store') }}">
			@csrf
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
							{{-- <label>Titulo de la publicación</label> --}}
							<input  type="text" 
											name="title"
											value="{{ old('title') }}" 
											class="form-control" 
											placeholder="Ingrese aqui el titulo de la publicación" />
							{!! $errors->first('title', '<span class="help-block">:message</span>') !!}
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-primary">Crear publicación</button>
				</div>
			</div>
		</form>
		</div>
	</div>

@endsection

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/bootstrap-data-table/css/jquery.bdt.min.css') }}">
@endpush

@push('scripts')
	<script src="{{ asset('adminLTE/plugins/bootstrap-data-table/js/vendor/jquery.sortelements.js') }}"></script>
	<script src="{{ asset('adminLTE/plugins/bootstrap-data-table/js/jquery.bdt.min.js') }}" ></script>
@endpush

@section('before_script')

	<script>
	    $(function () {
	      $('#posts-table').bdt({
	        'paging'      : true,
	        'lengthChange': false,
	        'searching'   : false,
	        'ordering'    : true,
	        'info'        : true,
	        'autoWidth'   : false
	      })
	    })
	</script>

@endsection