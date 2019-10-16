<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id', 'DESC')->paginate();
        //dd($categories); verificamos que el array y la consulta esten bien
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //este metodo guarda los datos
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->all());

        return redirect()->route('categories.edit', $category->id)
            ->with('info', 'Categoria creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra los detalles del category
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo muestra el formulario para editar el category
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo actualiza el category y lo guarda
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        $category->fill($request->all())->save();

        return redirect()->route('categories.edit', $category->id)
            ->with('info', 'Categoria actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //este metodo elimina el category
    public function destroy($id)
    {
        Category::find($id)->delete();
        return back()->with('info', 'Etiqueta eliminada');
    }
}
