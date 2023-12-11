<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Europe\CountrySeeder;
use Database\Seeders\Europe\Provinces\BelgiumSeeder;
use Database\Seeders\Europe\Provinces\GermanySeeder;
use Database\Seeders\Europe\Provinces\NetherlandsSeeder;
use Database\Seeders\Europe\Cities\NetherlandsCitiesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call(CountrySeeder::class);

         $this->call(NetherlandsSeeder::class);
         $this->call(BelgiumSeeder::class); 
         $this->call(GermanySeeder::class); 

         $this->call(NetherlandsCitiesSeeder::class); 

         $this->call(MembershipPlanSeeder::class);
         $this->call(UserSeeder::class);


    }
}
