<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['name' => 'KPk', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Punjab', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sindh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Balochistan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AJK', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gilgit Baltistan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Islamabad', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
