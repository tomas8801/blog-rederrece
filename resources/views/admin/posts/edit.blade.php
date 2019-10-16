@extends('layouts.app')


@section('content')

<div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        Editar post
                    </div>
    
                    <div class="card-body">
                        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => 'true']) !!}

                            @include('admin.posts.partials.form')

                        {!! Form::close() !!}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection