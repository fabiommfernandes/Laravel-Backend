<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(NewsTableSeeder::class);
        $this->call(NewsTranslationsTableSeeder::class);
        $this->call(PoliciesTableSeeder::class);
        $this->call(PoliciesTranslationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(ServicesTranslationsTableSeeder::class);   
    }
}
