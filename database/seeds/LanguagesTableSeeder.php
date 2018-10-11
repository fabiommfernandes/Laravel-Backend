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

        DB::table('languages')->insert([

            'name' => 'en',

            'created_at' => date("Y-m-d H:i:s")

        ]);

        DB::table('languages')->insert([

            'name' => 'fr',

            'created_at' => date("Y-m-d H:i:s")

        ]);
    }
}
