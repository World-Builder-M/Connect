<?php
namespace Database\Seeders\Europe;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    // Europese landen in een Nederlands format
    public function run()
    {
        $countries = [
            ['name' => 'Albanië', 'code' => 'AL', 'phonecode' => '+355'],
            ['name' => 'Andorra', 'code' => 'AD', 'phonecode' => '+376'],
            ['name' => 'Armenië', 'code' => 'AM', 'phonecode' => '+374'],
            ['name' => 'Oostenrijk', 'code' => 'AT', 'phonecode' => '+43'],
            ['name' => 'Azerbeidzjan', 'code' => 'AZ', 'phonecode' => '+994'],
            ['name' => 'België', 'code' => 'BE', 'phonecode' => '+32'],
            ['name' => 'Bosnië en Herzegovina', 'code' => 'BA', 'phonecode' => '+387'],
            ['name' => 'Bulgarije', 'code' => 'BG', 'phonecode' => '+359'],
            ['name' => 'Kroatië', 'code' => 'HR', 'phonecode' => '+385'],
            ['name' => 'Cyprus', 'code' => 'CY', 'phonecode' => '+357'],
            ['name' => 'Tsjechië', 'code' => 'CZ', 'phonecode' => '+420'],
            ['name' => 'Denemarken', 'code' => 'DK', 'phonecode' => '+45'],
            ['name' => 'Estland', 'code' => 'EE', 'phonecode' => '+372'],
            ['name' => 'Finland', 'code' => 'FI', 'phonecode' => '+358'],
            ['name' => 'Frankrijk', 'code' => 'FR', 'phonecode' => '+33'],
            ['name' => 'Georgië', 'code' => 'GE', 'phonecode' => '+995'],
            ['name' => 'Duitsland', 'code' => 'DE', 'phonecode' => '+49'],
            ['name' => 'Griekenland', 'code' => 'GR', 'phonecode' => '+30'],
            ['name' => 'Hongarije', 'code' => 'HU', 'phonecode' => '+36'],
            ['name' => 'IJsland', 'code' => 'IS', 'phonecode' => '+354'],
            ['name' => 'Ierland', 'code' => 'IE', 'phonecode' => '+353'],
            ['name' => 'Italië', 'code' => 'IT', 'phonecode' => '+39'],
            ['name' => 'Luxemburg', 'code' => 'LU', 'phonecode' => '+352'],
            ['name' => 'Nederland', 'code' => 'NL', 'phonecode' => '+31'],
            ['name' => 'Noorwegen', 'code' => 'NO', 'phonecode' => '+47'],
            ['name' => 'Polen', 'code' => 'PL', 'phonecode' => '+48'],
            ['name' => 'Portugal', 'code' => 'PT', 'phonecode' => '+351'],
            ['name' => 'Roemenië', 'code' => 'RO', 'phonecode' => '+40'],
            ['name' => 'Rusland', 'code' => 'RU', 'phonecode' => '+7'],
            ['name' => 'San Marino', 'code' => 'SM', 'phonecode' => '+378'],
            ['name' => 'Servië', 'code' => 'RS', 'phonecode' => '+381'],
            ['name' => 'Slowakije', 'code' => 'SK', 'phonecode' => '+421'],
            ['name' => 'Slovenië', 'code' => 'SI', 'phonecode' => '+386'],
            ['name' => 'Spanje', 'code' => 'ES', 'phonecode' => '+34'],
            ['name' => 'Zweden', 'code' => 'SE', 'phonecode' => '+46'],
            ['name' => 'Zwitserland', 'code' => 'CH', 'phonecode' => '+41'],
            ['name' => 'Macedonië', 'code' => 'MK', 'phonecode' => '+389'],
            ['name' => 'Malta', 'code' => 'MT', 'phonecode' => '+356'],
            ['name' => 'Moldavië', 'code' => 'MD', 'phonecode' => '+373'],
            ['name' => 'Monaco', 'code' => 'MC', 'phonecode' => '+377'],
            ['name' => 'Montenegro', 'code' => 'ME', 'phonecode' => '+382'],
            ['name' => 'Noord-Macedonië', 'code' => 'NM', 'phonecode' => '+389'],
            ['name' => 'Oekraïne', 'code' => 'UA', 'phonecode' => '+380'],
            ['name' => 'Turkije', 'code' => 'TR', 'phonecode' => '+90'],
            ['name' => 'Vaticaanstad', 'code' => 'VA', 'phonecode' => '+39'],
            ['name' => 'Verenigd Koninkrijk', 'code' => 'GB', 'phonecode' => '+44'],
            ['name' => 'Wit-Rusland', 'code' => 'BY', 'phonecode' => '+375'],
        ];

        DB::table('countries')->insert($countries);
    }
}
