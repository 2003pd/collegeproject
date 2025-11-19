<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Men T-Shirt',
                'price' => 499,
                'category_id' => 1,
                'description' => 'Cool cotton T-shirt',
                'image' => 'men-tshirt.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Women Dress',
                'price' => 999,
                'category_id' => 2,
                'description' => 'Beautiful summer dress',
                'image' => 'women-dress.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
