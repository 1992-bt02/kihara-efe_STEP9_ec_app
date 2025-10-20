<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $book = Product::where('slug', 'laravel-book')->first();
        $watch = Product::where('slug', 'smartwatch-pro')->first();

        if ($book) {
            ProductImage::updateOrCreate(
                ['product_id' => $book->id, 'is_main' => true],
                ['path' => 'images/laravel-book_main.jpg']
            );
        }

        if ($watch) {
            ProductImage::updateOrCreate(
                ['product_id' => $watch->id, 'is_main' => true],
                ['path' => 'images/smartwatch-pro_main.jpg']
            );
        }
    }
}