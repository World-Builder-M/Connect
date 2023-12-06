<?php

namespace Database\Seeders\Europe\Cities;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetherlandsCitiesSeeder extends Seeder
{
    /**
     * Run the seeder.
     */
    public function run(): void
    {
        $provinceIds = [
            'Noord-Holland' => 1,
            'Zuid-Holland' => 2,
            'Utrecht' => 3,
            'Groningen' => 4,
            'Friesland' => 5,
            'Drenthe' => 6,
            'Overijssel' => 7,
            'Gelderland' => 8,
            'Limburg' => 9,
            'Noord-Brabant' => 10,
            'Flevoland' => 11,
            'Zeeland' => 12,
        ];

        $cities = [
            // Cities in Noord-Holland
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Amsterdam'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Haarlem'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Alkmaar'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Hoorn'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Hilversum'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Purmerend'],
            ['province_id' => $provinceIds['Noord-Holland'], 'name' => 'Amstelveen'],

            // Cities in Zuid-Holland
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Rotterdam'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Den Haag'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Leiden'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Delft'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Gouda'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Scheveningen'],
            ['province_id' => $provinceIds['Zuid-Holland'], 'name' => 'Dordrecht'],

            // Cities in Utrecht
            ['province_id' => $provinceIds['Utrecht'], 'name' => 'Utrecht'],
            ['province_id' => $provinceIds['Utrecht'], 'name' => 'Amersfoort'],
            ['province_id' => $provinceIds['Utrecht'], 'name' => 'Nieuwegein'],
            ['province_id' => $provinceIds['Utrecht'], 'name' => 'Zeist'],

            // Cities in Groningen
            ['province_id' => $provinceIds['Groningen'], 'name' => 'Groningen'],
            ['province_id' => $provinceIds['Groningen'], 'name' => 'Winschoten'],

            // Cities in Friesland
            ['province_id' => $provinceIds['Friesland'], 'name' => 'Leeuwarden'],
            ['province_id' => $provinceIds['Friesland'], 'name' => 'Heerenveen'],

            // Cities in Drenthe
            ['province_id' => $provinceIds['Drenthe'], 'name' => 'Assen'],
            ['province_id' => $provinceIds['Drenthe'], 'name' => 'Emmen'],

            // Cities in Overijssel
            ['province_id' => $provinceIds['Overijssel'], 'name' => 'Zwolle'],
            ['province_id' => $provinceIds['Overijssel'], 'name' => 'Enschede'],

            // Cities in Gelderland
            ['province_id' => $provinceIds['Gelderland'], 'name' => 'Arnhem'],
            ['province_id' => $provinceIds['Gelderland'], 'name' => 'Nijmegen'],
            ['province_id' => $provinceIds['Gelderland'], 'name' => 'Apeldoorn'],

            // Cities in Limburg
            ['province_id' => $provinceIds['Limburg'], 'name' => 'Maastricht'],
            ['province_id' => $provinceIds['Limburg'], 'name' => 'Venlo'],
            ['province_id' => $provinceIds['Limburg'], 'name' => 'Heerlen'],

            // Cities in Noord-Brabant
            ['province_id' => $provinceIds['Noord-Brabant'], 'name' => 'Eindhoven'],
            ['province_id' => $provinceIds['Noord-Brabant'], 'name' => "'s-Hertogenbosch"],
            ['province_id' => $provinceIds['Noord-Brabant'], 'name' => 'Tilburg'],
            ['province_id' => $provinceIds['Noord-Brabant'], 'name' => 'Breda'],

            // Cities in Flevoland
            ['province_id' => $provinceIds['Flevoland'], 'name' => 'Almere'],
            ['province_id' => $provinceIds['Flevoland'], 'name' => 'Lelystad'],

            // Cities in Zeeland
            ['province_id' => $provinceIds['Zeeland'], 'name' => 'Middelburg'],
            ['province_id' => $provinceIds['Zeeland'], 'name' => 'Vlissingen'],
            ['province_id' => $provinceIds['Zeeland'], 'name' => 'Goes'],

        ];

        DB::table('cities')->insert($cities);
    }
}