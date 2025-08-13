<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'iPhone 14 Pro Max',
                'img_url' => 'images/products/iphone14.jpg',
                'description' => 'Điện thoại Apple cao cấp nhất 2023.',
                'price' => 29990000,
                'quantity' => rand(10, 100), // Thêm số lượng
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung Galaxy S23 Ultra',
                'img_url' => 'images/products/s23ultra.jpg',
                'description' => 'Flagship mạnh mẽ nhất của Samsung.',
                'price' => 26990000,
                'quantity' => rand(10, 100),
                'category_id' => 1,
                'brand_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MacBook Pro 16 inch',
                'img_url' => 'images/products/macbookpro16.jpg',
                'description' => 'Laptop Apple hiệu năng cao dành cho dân chuyên.',
                'price' => 59990000,
                'quantity' => rand(10, 100),
                'category_id' => 2,
                'brand_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell XPS 15',
                'img_url' => 'images/products/dellxps15.jpg',
                'description' => 'Laptop cao cấp của Dell, mỏng nhẹ và mạnh mẽ.',
                'price' => 45990000,
                'quantity' => rand(10, 100),
                'category_id' => 2,
                'brand_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi Mi Band 8',
                'img_url' => 'images/products/miband8.jpg',
                'description' => 'Vòng đeo tay thông minh giá rẻ, nhiều tính năng.',
                'price' => 990000,
                'quantity' => rand(10, 100),
                'category_id' => 3,
                'brand_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
