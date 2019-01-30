<?php

use Illuminate\Database\Seeder;

class ServicesTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ServicesTranslations::class, 3)->create();

    }
}
