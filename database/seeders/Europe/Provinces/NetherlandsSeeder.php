<?php
namespace Database\Seeders\Europe\Provinces;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetherlandsSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $countryId = DB::table('countries')->where('code', 'NL')->value('id');

        $provinces = [
            ['country_id' => $countryId, 'name' => 'Noord-Holland'],
            ['country_id' => $countryId, 'name' => 'Zuid-Holland'],
            ['country_id' => $countryId, 'name' => 'Utrecht'],
            ['country_id' => $countryId, 'name' => 'Groningen'],
            ['country_id' => $countryId, 'name' => 'Friesland'],
            ['country_id' => $countryId, 'name' => 'Drenthe'],
            ['country_id' => $countryId, 'name' => 'Overijssel'],
            ['country_id' => $countryId, 'name' => 'Gelderland'],
            ['country_id' => $countryId, 'name' => 'Limburg'],
            ['country_id' => $countryId, 'name' => 'Noord-Brabant'],
            ['country_id' => $countryId, 'name' => 'Flevoland'],
            ['country_id' => $countryId, 'name' => 'Zeeland'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}
