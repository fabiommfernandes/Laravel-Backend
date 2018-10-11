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
        /* -----
        CALL SEEDERS IN THIS ORDER: 
        users
        admin
        languages
        news
        news translations
        faqs
        faqs translations
        policies
        policies translations
        contacts
        ----- */

        $this->call(AdminsTableSeeder::class); 
        $this->call(LanguagesTableSeeder::class);
        $this->call(PoliciesTableSeeder::class);
        $this->call(PoliciesTranslationsTableSeeder::class);
        $this->call(ContactsTableSeeder::class);
        
    }
}
