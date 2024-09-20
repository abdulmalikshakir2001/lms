<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert programs into the database
        DB::table('programs')->insert([
            [
                'name' => 'Child Online Protection',
                'description' => 'A program aimed at protecting children online by raising awareness and providing resources.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Facilitator',
                'description' => 'A program designed to train facilitators for various educational initiatives.',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
