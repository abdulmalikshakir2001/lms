<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class session_forTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('session_fors')->insert([
            [
                'name' => 'Students',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Edu Partners',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Trainers',
                'created_at' => now(),
                'updated_at' => now()
            ]
            
        ]);
    }
}
