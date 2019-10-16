<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use App\Tag;

class PageController extends Controller
{
    public function blog(){
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        return view('web.posts', compact('posts'));
    }




    public function post($slug){
        $post = Post::where('slug', $slug)->first();
        return view('web.post', compact('post'));
    }




    //filtrado por categoria
    public function category($slug){ 
        //nos devuelve el registro con su id de la categoria donde slug es igual al parametro $slug
        $category = Category::where('slug', $slug)->pluck('id')->first();
        //luego obtenemos a traves de ese id la categoria y todos sus posts
        $posts = Post::where('category_id', $category )
        ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        return view('web.posts', compact('posts'));
    }




    //filtrado por etiquetas
    public function tag($slug){ 
        
        //luego obtenemos a traves de ese id la categoria y todos sus posts
        $posts = Post::whereHas('tags', function ($query) use ($slug){ //obtenemos los post que TENGAN tags
            $query->where('slug', $slug); //condicion que afecta a las etiquetas (que las etiquetas tengan el slug)
        })
        ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        return view('web.posts', compact('posts'));
    }
    
}
