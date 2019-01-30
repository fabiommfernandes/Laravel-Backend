<?php

use Faker\Generator as Faker;

$factory->define(App\NewsTranslations::class, function (Faker $faker) {
    return [
        'title' => $faker->text,

        'subtitle' => $faker->text,

        'description' => $faker->text,
        
        'thumbnail' => $faker->imageUrl('400', '400', 'cats'), 

        'localeId' => '1',
        
        'newsId' => App\News::pluck('id')->random(),

        'created_at' => date("Y-m-d H:i:s")
    ];
});
