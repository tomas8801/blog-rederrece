<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
//definimos el modelo
$factory->define(App\Category::class, function (Faker $faker) {
    //estructura de la tabla (columnas)
    $title = $faker->sentence(4); //oracion de 4 palabras
    return [
        'name' => $title,
        'slug' => Str::slug($title, '-'),
        'body' => $faker->text(500),

    ];
});
