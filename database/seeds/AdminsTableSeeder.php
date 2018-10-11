<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([

            'firstName' => 'Ricardo',

            'lastName' => 'Guerreiro',

            'email' => 'r.guerreiro@comup.pt',

            'password' => bcrypt('admin'),

            'type' => '1',

            'created_at' => date("Y-m-d H:i:s")

        ]);

        DB::table('admins')->insert([

            'firstName' => 'Fabio',

            'lastName' => 'Fernandes',

            'email' => 'f.fernandes@comup.pt',

            'password' => bcrypt('admin'),

            'type' => '1',

            'created_at' => date("Y-m-d H:i:s")

        ]);

    }
}
