<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // akun admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '085335249308',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'group_id' => 1,
            'roles' => 'ADMIN',
            'level' => 'ADMIN',
        ]);

        DB::table('groups')->insert([
            ['user_Cat' => 'ADMIN'],
            ['user_Cat' => 'STAFF'],
            ['user_Cat' => 'USER']
        ]);

        DB::table('areas')->insert([
            [
                'area_name' => 'Jababeka',
                'description' => 'Blok A'
            ],
            [
                'area_name' => 'Jababeka B',
                'description' => 'Blok B'
            ]
        ]);

        DB::table('early_warnings')->insert([
            [
                'water_level' => '10',
                'area_id' => 1,
                'status' => 'Safe',
            ]
        ]);

        DB::table('trashes')->insert([
            [
                'trash_level' => 10,
                'area_id' => 1,
                'status' => "Full"
            ],
        ]);
    }
}