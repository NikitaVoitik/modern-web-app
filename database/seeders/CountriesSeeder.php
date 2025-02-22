<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['id' => 'AT', 'name' => 'Austria'],
            ['id' => 'BE', 'name' => 'Belgium'],
            ['id' => 'BG', 'name' => 'Bulgaria'],
            ['id' => 'HR', 'name' => 'Croatia'],
            ['id' => 'CY', 'name' => 'Cyprus'],
            ['id' => 'CZ', 'name' => 'Czech Republic'],
            ['id' => 'DK', 'name' => 'Denmark'],
            ['id' => 'EE', 'name' => 'Estonia'],
            ['id' => 'FI', 'name' => 'Finland'],
            ['id' => 'FR', 'name' => 'France'],
            ['id' => 'DE', 'name' => 'Germany'],
            ['id' => 'GR', 'name' => 'Greece'],
            ['id' => 'HU', 'name' => 'Hungary'],
            ['id' => 'IE', 'name' => 'Ireland'],
            ['id' => 'IT', 'name' => 'Italy'],
            ['id' => 'LV', 'name' => 'Latvia'],
            ['id' => 'LT', 'name' => 'Lithuania'],
            ['id' => 'LU', 'name' => 'Luxembourg'],
            ['id' => 'MT', 'name' => 'Malta'],
            ['id' => 'NL', 'name' => 'Netherlands'],
            ['id' => 'PL', 'name' => 'Poland'],
            ['id' => 'PT', 'name' => 'Portugal'],
            ['id' => 'RO', 'name' => 'Romania'],
            ['id' => 'SK', 'name' => 'Slovakia'],
            ['id' => 'SI', 'name' => 'Slovenia'],
            ['id' => 'ES', 'name' => 'Spain'],
            ['id' => 'SE', 'name' => 'Sweden'],
        ];

        // Insert data into the 'eu_countries' table
        DB::table('countries')->insert($countries);
    }
}
