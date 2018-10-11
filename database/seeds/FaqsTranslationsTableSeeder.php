<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FaqsTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    	foreach (range(1,3) as $index) {
	        DB::table('faqstranslations')>insert([
	            'question' => $faker>text,

                'answer' => $faker>text,

                'localeId' => App\Language::pluck('id')>random(),
                
                'faqsId' => App\Faqs::pluck('id')>random(),

                'created_at' => date("Ymd H:i:s")
	        ]);
        }
    }
}