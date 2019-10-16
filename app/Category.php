<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        //damos de alta los campos para proteger nuestra aplicacion
        'name', 'slug', 'body'
    ];

    public function posts(){
        //una categoria tiene muchos posts (es hasMany porque no es una relacion muchos a muchos)
        return $this->hasMany(Post::class);
    }

}
