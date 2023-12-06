<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Dit is Amerikaanse data voor lokaal testen
        // $this->call(CountrySeeder::class);
        // $this->call(ProvinceSeeder::class);
        // $this->call(CitySeeder::class); 

         $this->call(UserSeeder::class);

        // Abonnement enum voor gebruikers
        // $this->call(MembershipPlanSeeder::class);

    }
}
