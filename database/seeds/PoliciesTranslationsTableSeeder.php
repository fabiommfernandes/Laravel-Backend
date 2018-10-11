<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PoliciesTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 2; $i++) { 
	        DB::table('policiestranslations')->insert([
	            'title' => $faker->text,

                'description' => $faker->text,

                'localeId' => $i+1,
                
                'policiesId' => App\Policy::pluck('id')->random(),

                'created_at' => date("Y-m-d H:i:s")

            ]); 
        }
    }
}
