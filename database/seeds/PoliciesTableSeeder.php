<?php

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	        DB::table('policies')->insert([
                'created_at' => date("Y-m-d H:i:s")
            ]);
    }
}
