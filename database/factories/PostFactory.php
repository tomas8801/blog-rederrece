<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

//definimos el modelo
$factory->define(App\Post::class, function (Faker $faker) {
    //estructura de la tabla (columnas)
    $title = $faker->sentence(4); //oracion de 4 palabras
    return [
        'user_id' => rand(1,30), //deberia crear 30 usuarios
        'category_id' => rand(1,20), //y 20 categorias
        'name' => $title,
        'slug' => Str::slug($title, '-'),
        'excerpt' => $faker->text(200),
        'body' => $faker->text(500),
        'file' => $faker->imageUrl($width = 1200, $height = 400),
        'status' => $faker->randomElement(['DRAFT', 'PUBLISHED'])

    ];
});
