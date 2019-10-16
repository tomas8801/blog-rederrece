<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   

    protected $fillable = [
        //damos de alta los campos para proteger nuestra aplicacion
        'user_id', 'category_id', 'tags', 'name', 'slug', 'excerpt', 'body', 'status', 'file'
    ];

    public function user(){
        //un post pertenece a UN usuario (user)
        return $this->belongsTo(User::class);
    }

    public function category(){
        //un post pertenece a UNA categoria (category)
        return $this->belongsTo(Category::class);
    }
    public function tags(){
        //un post pertenece o tiene muchas etiquetas (tags)
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
