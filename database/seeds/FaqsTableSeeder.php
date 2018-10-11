<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 3; $i++) { 

            DB::table('faqs')>insert([
                'created_at' => date("Ymd H:i:s")
            ]);
        }
    }
}