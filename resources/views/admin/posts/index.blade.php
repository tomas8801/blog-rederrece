@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    Lista de posts
                    <a href="{{ route('posts.create')}}" class="btn btn-primary btn-sm float-right">Crear</a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th colspan="3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td width="10px">
                                    <a href="{{ route('posts.show', $post->id )}}" class="btn btn-sm btn-default">Ver</a>                  
                                </td>
                                <td width="10px">
                                    <a href="{{ route('posts.edit', $post->id )}}" class="btn btn-sm btn-default">Editar</a>                  
                                </td>
                                <td width="10px">
                                    {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
                                        <button class="btn btn-sm btn-danger">
                                            Eliminar
                                        </button>
                                    {!! Form::close() !!}            
                                </td>
                            </tr>                          
                            @endforeach
                        </tbody>
                    </table>
                    {{ $posts->render()}}
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection