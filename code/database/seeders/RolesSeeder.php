<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('u_role')->insert([
            'description' => 'Dashboard',
        ]);

        DB::table('u_role')->insert([
            'description' => 'Categories',
        ]);
        
        DB::table('u_role')->insert([
            'description' => 'Post',
        ]);

        DB::table('u_role')->insert([
            'description' => 'User',
        ]);
    }
}
