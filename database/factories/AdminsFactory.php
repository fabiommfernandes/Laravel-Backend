<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'firstName' => 'Basic',

        'lastName' => 'Admin',

        'email' => 'admin@admin.pt',

        'password' => bcrypt('admin'),

        'type' => '1',

        'created_at' => date("Y-m-d H:i:s")

    ];
});
