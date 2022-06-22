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
        $this->call([
            UserSeeder::class,
            SponsorshipSeeder::class,
            AddSeeder::class,
            ApartmentsSeeder::class,
            MessageSeeder::class,
            Apartment_SponsorshipSeeder::class,
        ]);
    }
}
