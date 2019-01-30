<?php

use Faker\Generator as Faker;

$factory->define(App\Policy::class, function (Faker $faker) {
    return [
        'created_at' => date("Y-m-d H:i:s")
    ];
});
