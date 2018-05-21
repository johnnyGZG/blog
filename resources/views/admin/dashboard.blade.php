@extends('admin.layout')

@section('content')

	<h1> Panel de Control </h1>

	<p>Usuario Autenticado: {{ auth()->user()->name }}</p>

@endsection