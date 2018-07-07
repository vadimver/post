<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'last_name' => '',
            'role' => 1,
            'email' => 'admin@mail.com',
            'phone' => '+80631111111',
            'password' => bcrypt('secret'),
        ]);
        
        factory(App\User::class, 10)->create();
    }
}
