@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-8 mx-auto">
            <h1 class="text-center">{{ $post->name}}</h1>


            <div class="card mb-3">
                <div class="card-header p-3">
                    Categoría
                    <a href="{{ route('category', $post->category->slug )}}">{{ $post->category->name }}</a>
                </div>

                <img src="{{ $post->file }}" class="card-img-top" alt="...">
                <div class="card-body py-4">
                    <h5 class="card-title">{{ $post->name }}</h5>
                    <p class="card-text">{{ $post->excerpt }}</p>
                    <p class="card-text">{{ $post->body }}</p>
                </div>

                <div class="card-footer p-3">
                    Etiquetas
                    @foreach ($post->tags as $tag)

                        <a href="{{ route('tag', $tag->slug )}}" class="">{{$tag->name}}</a>
                        
                        
                    @endforeach
                </div>
            </div>



        </div>
    </div>
@endsection