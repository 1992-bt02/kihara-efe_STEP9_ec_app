<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Laravel入門ブック',
                'slug' => 'laravel-book',
                'description' => 'Laravel学習に最適な入門書。',
                'price' => 1980,
                'stock' => 20,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'スマートウォッチ Pro',
                'slug' => 'smartwatch-pro',
                'description' => '健康管理も通知もこれ1台。',
                'price' => 15800,
                'stock' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}