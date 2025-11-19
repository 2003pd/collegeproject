<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Required for DB facade

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Men', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Women', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
