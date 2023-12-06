<?php
namespace Database\Seeders\Europe\Provinces;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BelgiumSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        // Get the ID of Belgium from the countries table
        $countryId = DB::table('countries')->where('code', 'BE')->value('id');

        $provinces = [
            ['country_id' => $countryId, 'name' => 'Antwerpen'],
            ['country_id' => $countryId, 'name' => 'Oost-Vlaanderen'],
            ['country_id' => $countryId, 'name' => 'West-Vlaanderen'],
            ['country_id' => $countryId, 'name' => 'Vlaams-Brabant'],
            ['country_id' => $countryId, 'name' => 'Waals-Brabant'],
            ['country_id' => $countryId, 'name' => 'Henegouwen'],
            ['country_id' => $countryId, 'name' => 'Luik'],
            ['country_id' => $countryId, 'name' => 'Luxemburg'],
            ['country_id' => $countryId, 'name' => 'Namen'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
