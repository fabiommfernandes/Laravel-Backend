<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NewsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 3; $i++) { 

            DB::table('news')>insert([

                'state' => '1',

                'created_at' => date("Ymd H:i:s")


            ]);
        }
    }
}