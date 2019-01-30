<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'state' => '1',
        
        'created_at' => date("Y-m-d H:i:s")

    ];
});
