<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserroleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('u_user_roles')->insert([
            'user_id' => '1',
            'role_id' => '1'
        ]);

        DB::table('u_user_roles')->insert([
            'user_id' => '1',
            'role_id' => '2'
        ]);
        
        DB::table('u_user_roles')->insert([
            'user_id' => '1',
            'role_id' => '2'
        ]);

        DB::table('u_user_roles')->insert([
            'user_id' => '1',
            'role_id' => '3'
        ]);

        DB::table('u_user_roles')->insert([
            'user_id' => '1',
            'role_id' => '4'
        ]);
    }
}
