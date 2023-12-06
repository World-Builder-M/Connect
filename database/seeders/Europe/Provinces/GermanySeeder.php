<?php
namespace Database\Seeders\Europe\Provinces;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GermanySeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $countryId = DB::table('countries')->where('code', 'DE')->value('id');

        $states = [
            ['country_id' => $countryId, 'name' => 'Baden-Württemberg'],
            ['country_id' => $countryId, 'name' => 'Bavaria (Bayern)'],
            ['country_id' => $countryId, 'name' => 'Berlin'],
            ['country_id' => $countryId, 'name' => 'Brandenburg'],
            ['country_id' => $countryId, 'name' => 'Bremen'],
            ['country_id' => $countryId, 'name' => 'Hamburg'],
            ['country_id' => $countryId, 'name' => 'Hesse (Hessen)'],
            ['country_id' => $countryId, 'name' => 'Lower Saxony (Niedersachsen)'],
            ['country_id' => $countryId, 'name' => 'Mecklenburg-Vorpommern'],
            ['country_id' => $countryId, 'name' => 'North Rhine-Westphalia (Nordrhein-Westfalen)'],
            ['country_id' => $countryId, 'name' => 'Rhineland-Palatinate (Rheinland-Pfalz)'],
            ['country_id' => $countryId, 'name' => 'Saarland'],
            ['country_id' => $countryId, 'name' => 'Saxony (Sachsen)'],
            ['country_id' => $countryId, 'name' => 'Saxony-Anhalt (Sachsen-Anhalt)'],
            ['country_id' => $countryId, 'name' => 'Schleswig-Holstein'],
            ['country_id' => $countryId, 'name' => 'Thuringia (Thüringen)'],
        ];

        DB::table('provinces')->insert($states);
    }
}