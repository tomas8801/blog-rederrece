<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

//definimos el modelo
$factory->define(App\Tag::class, function (Faker $faker) {
    //estructura de la tabla (columnas)
    $title = $faker->unique()->word(5); //palabra de 4 letras
    return [
        'name' => $title,
        'slug' => Str::slug($title, '-'),

    ];
});
