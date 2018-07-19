<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsigneesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('consignees')->insert([
            'id' => 1,
            'name' => 'test',
            'last_name' => 'test',
            'phone' => '80631111111'
        ]);
    }
}
