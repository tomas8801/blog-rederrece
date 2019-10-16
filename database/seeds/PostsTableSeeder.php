<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cada vez que se cree un post va a existir una relacion con 3 etiquetas aleatorias
        factory(App\Post::class, 300)->create()->each(function(App\Post $post){
            $post->tags()->attach([
                rand(1,5),
                rand(6,14),
                rand(15,20),
            ]);
            // el metodo tags() debe existir en el modelo/entidad
        });
    }
}
