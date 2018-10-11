<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	        DB::table('contacts')->insert([
	            'email' => $faker->email,

                'phone' => $faker->phoneNumber,

                'secondaryPhone' => $faker->phoneNumber,
                
                'adress' => $faker->address,

                'facebook' => $faker->url,

                'twitter' => $faker->url,

                'linkedin' => $faker->url,

                'created_at' => date("Y-m-d H:i:s")
	        ]);
    }
}