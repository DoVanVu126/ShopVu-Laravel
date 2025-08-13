<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Điện thoại',
                'description' => 'Các loại điện thoại thông minh, phổ thông và phụ kiện liên quan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop',
                'description' => 'Laptop cho văn phòng, gaming, học tập và các dòng cao cấp.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thiết bị thông minh',
                'description' => 'Đồng hồ thông minh, nhà thông minh và các thiết bị IoT.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
