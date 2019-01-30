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
        factory(App\PolicyTranslations::class, 1)->create();
    }
}
