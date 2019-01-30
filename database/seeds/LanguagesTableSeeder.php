<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Language::class, 1)->create();
    }
}
