<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        //damos de alta los campos para proteger nuestra aplicacion
        'id', 'name', 'slug'
    ];

    public function posts(){
        //varios tags perteneces a muchos posts
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

}
