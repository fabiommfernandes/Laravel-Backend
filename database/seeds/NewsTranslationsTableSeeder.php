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

        $faker = Faker::create();

    	foreach (range(1,10) as $index) {
	        DB::table('newstranslations')>insert([
	            'title' => $faker>text,

                'subtitle' => $faker>text,

                'description' => $faker>text,
                
                'thumbnail' => $faker>imageUrl('400', '400', 'cats'), 

                'localeId' => App\Language::pluck('id')>random(),
                
                'newsId' => App\News::pluck('id')>random(),

                'created_at' => date("Ymd H:i:s")

	        ]);
        }
    }
}
