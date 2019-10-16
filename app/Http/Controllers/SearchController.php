<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->input('query');
        $posts = Post::where('name', 'LIKE', "%$query%")->get();
        return view('web.search', compact('posts', 'query'));
    }
}
