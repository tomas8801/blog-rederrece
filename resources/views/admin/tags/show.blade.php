@extends('layouts.app')


@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Ver etiqueta
                    </div>
    
                    <div class="card-body">
                    <p><strong>Nombre </strong>{{ $tag->name }}</p>
                    <p><strong>Slug </strong>{{ $tag->slug }}</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection