<?php

use Faker\Generator as Faker;

$factory->define(App\PolicyTranslations::class, function (Faker $faker) {
    return [
        'title' => $faker->text,

        'description' => $faker->text,

        'localeId' => '1',
        
        'policiesId' => App\Policy::pluck('id')->random(),

        'created_at' => date("Y-m-d H:i:s")
    ];
});
