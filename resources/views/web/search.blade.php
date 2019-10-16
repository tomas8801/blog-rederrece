@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10 mx-auto">
            <h3 class=""> {{ $posts->count() }} Resultados de {{ $query }}</h3>

            @foreach ($posts as $item)

                <div class="card bg-dark text-white text-center my-4">

                    <img src="{{ $item->file }}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h2 class="card-title p-4">{{ $item->name }}</h2>
                        <p class="card-text">{{ $item->excerpt }}</p>
                        <a href="{{ route('post', $item->slug) }}" class="pull-right">Leer más</a>
                    </div>
              </div>
                
            @endforeach
        </div>
    </div>
@endsection