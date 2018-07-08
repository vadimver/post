<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = DB::table('cities')->get();
        
        $number = 1;
        foreach ($cities as $city) {
            
            $rand = mt_rand(5, 25);
            
            for ($i = 0; $i < $rand; $i++) {
                DB::table('offices')->insert([
                    'region_id' => $city->region_id,
                    'city_id' => $city->id,
                    'number' => $number,
                ]);
                $number++;
            }
        }
    }
}
