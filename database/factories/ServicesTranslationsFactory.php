<?php

use Faker\Generator as Faker;

$factory->define(App\ServicesTranslations::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'description' => $faker->text(50),
    ];
});
