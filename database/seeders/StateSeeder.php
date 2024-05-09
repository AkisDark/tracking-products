<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('states')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $filePath = database_path('seeders/states_and_cities/states.json');
        if (file_exists($filePath)) {
            $states = json_decode(file_get_contents($filePath), true);
            // 
            if (count($states) > 0) {
                $statesData = [];
                foreach ($states as $state) {
                    $statesData[] = [
                        'id' => $state['id'] ?? NULL,
                        'name' => $state['name_ar'] ?? ''
                    ];
                }
                DB::table('states')->insert($statesData);
            }
        }
    }
}
