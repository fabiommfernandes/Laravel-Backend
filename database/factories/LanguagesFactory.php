<?php

use Faker\Generator as Faker;

$factory->define(App\Language::class, function (Faker $faker) {
    return [
        'name' => 'en',

        'created_at' => date("Y-m-d H:i:s")

    ];
});
