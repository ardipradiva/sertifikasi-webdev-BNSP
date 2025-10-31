<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'thumbnail'    => 'images/iphone13pro.jpg',
                'category'     => 'Iphone 13 Pro',
                'product' => 'Iphone',
                'harga'        => 12000000,
                'created_at'   => now(), 'updated_at' => now(),
            ],
            [
                'thumbnail'    => 'images/sp02.jpg',
                'category'     => 'Samsung X flip',
                'product' => 'Samsung',
                'harga'        => 20000000,
                'created_at'   => now(), 'updated_at' => now(),
            ],
            [
                'thumbnail'    => 'images/sp03.jpg',
                'category'     => 'Xiaomi Redmi Note 11 Pro',
                'product' => 'Xiaomi',
                'harga'        => 3200000,
                'created_at'   => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
