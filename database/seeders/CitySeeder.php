<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('cities')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $filePath = database_path('seeders/states_and_cities/cities.json');
        if (file_exists($filePath)) {
            $cities = json_decode(file_get_contents($filePath), true);
            // 
            if (count($cities) > 0) {
                $data = [];
                foreach ($cities as $city) {
                    $data[] = [
                        'id' => $city['id'] ?? NULL,
                        'state_id' => $city['wilaya_code'] ?? NULL,
                        'name' => $city['daira_name'] ?? ''
                    ];
                }
                DB::table('cities')->insert($data);
            }
        }
    }
}
