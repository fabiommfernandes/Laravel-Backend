<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\News::class, 3)->create();
    }
}