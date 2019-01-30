<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'email' => $faker->email,

        'phone' => $faker->phoneNumber,

        'secondaryPhone' => $faker->phoneNumber,
        
        'adress' => $faker->address,

        'facebook' => $faker->url,

        'twitter' => $faker->url,

        'linkedin' => $faker->url,

        'created_at' => date("Y-m-d H:i:s")
    ];
});
