<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Books',   'slug' => 'books',   'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gadgets', 'slug' => 'gadgets', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
