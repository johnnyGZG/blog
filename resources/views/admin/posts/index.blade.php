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

	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
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