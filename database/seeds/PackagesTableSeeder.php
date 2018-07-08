<?php

use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            'user_id' => 1,
            'consign_id' => 1,
            'start_office_id' => 2,
            'finish_office_id' => 30,
            'delivery' => 3,
            'tracking' => time(),
            'status' => 1,
            'created_at' => '2018-07-08 08:20:20'
        ]);
    }
}
