<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Controllers\Controller;

use App\Tag;

class TagController extends Controller
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
        $tags = Tag::orderBy('id', 'DESC')->paginate();
        //dd($tags); verificamos que el array y la consulta esten bien
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //este metodo guarda los datos
    public function store(TagStoreRequest $request)
    {
        $tag = Tag::create($request->all());

        return redirect()->route('tags.edit', $tag->id)
            ->with('info', 'Etiqueta creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra los detalles del tag
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario para editar el tag
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo actualiza el tag y lo guarda
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::find($id);
        $tag->fill($request->all())->save();

        return redirect()->route('tags.edit', $tag->id)
            ->with('info', 'Etiqueta actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo elimina el tag
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return back()->with('info', 'Etiqueta eliminada');
    }
}
