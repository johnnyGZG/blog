@extends('layout')

@section('meta-title', $post->title)

@section('meta-description', $post->excerpt)

@section('content')

    <article class="post container">

        @if($post->photos->count() === 1)
            @include('posts.photo')
        @elseif($post->photos->count() > 1)
            @include('posts.carousel')
        @elseif($post->iframe)
            @include('posts.iframe')
        @endif
        
        <div class="content-post">

            @include('posts.header')

            <h1>{{ $post->title }}</h1>
            <div class="divider"></div>
            <div class="image-w-text">
                {!! $post->body !!}
            </div>

            <footer class="container-flex space-between">
            
            @include('partials.social-links', ['description' => $post->title])

            @include('posts.tags')

        </footer>
        <div class="comments">
        <div class="divider"></div>
        <div id="disqus_thread"></div>
        @include('partials.disqus-script')
  </article>

@endsection

@push('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
@endpush

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

@endpush