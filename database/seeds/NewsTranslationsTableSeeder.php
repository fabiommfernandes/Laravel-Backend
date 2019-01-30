<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NewsTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\NewsTranslations::class, 3)->create();
    }
}
