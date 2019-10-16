<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //primero validamos el inicio de sesion
    public function __construct(){
        $this->middleware('auth'); 
    }
    
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->paginate();
        //dd($posts); verificamos que el array y la consulta esten bien
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario
    public function create()
    {   
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id'); //traemos solo el nombre y el id
        $tags       = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //este metodo guarda los datos
    public function store(PostStoreRequest $request)
    {   
        $post = new Post;

        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->file = $request->file;

        //IMAGE
        //si enviamos un archivo file, entonces
        if($request->file){ 
            //almacena en el disco en la carpeta public dentro de la carpeta image la imagen que pasamos
            $path = Storage::disk('public')->put('image', $request->file('file'));
            //actualizamos la ruta creada arriba en el post creado
            $post->fill(['file' => asset($path)])->save();
        }

        $post->save();
        //TAGS
        //sincronizamos la relacion entre post y etiquetas
        $post->tags()->sync($request->tags, false);
        

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Post creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra los detalles del post
    public function show($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post); //verificamos si tenemos permiso para ese post
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario para editar el post
    public function edit($id)
    {
        $post       = Post::find($id);
        $this->authorize('pass', $post); //verificamos si tenemos permiso para ese post

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id'); //traemos solo el nombre y el id
        $tags       = Tag::orderBy('name', 'ASC')->get();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo actualiza el post y lo guarda
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);//buscamos el post
        $this->authorize('pass', $post); //verificamos si tenemos permiso para ese post

        $post->name = $request->name;
        $post->slug = $request->slug;
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->file = $request->file;

        //IMAGE
        //si enviamos un archivo file, entonces
        if($request->file){ 
            //almacena en el disco en la carpeta public dentro de la carpeta image la imagen que pasamos
            $path = Storage::disk('public')->put('image', $request->file('file'));
            //actualizamos la ruta creada arriba en el post creado
            $post->fill(['file' => asset($path)])->save();
        }
        
        $post->save();
        //TAGS
        //sincronizamos la relacion entre post y etiquetas
        $post->tags()->sync($request->tags, false);
        

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Post actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo elimina el post
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post); //verificamos si tenemos permiso para ese post
        $post->delete();
        return back()->with('info', 'Post eliminado');
    }
}
