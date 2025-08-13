<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'name' => 'Apple',
                'description' => 'Thương hiệu công nghệ hàng đầu với iPhone, MacBook, iPad.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samsung',
                'description' => 'Tập đoàn công nghệ Hàn Quốc nổi tiếng với smartphone và TV.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell',
                'description' => 'Nhà sản xuất máy tính xách tay và PC nổi tiếng toàn cầu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP',
                'description' => 'Thương hiệu máy tính, máy in lâu đời và uy tín.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Xiaomi',
                'description' => 'Thương hiệu Trung Quốc với smartphone và thiết bị thông minh giá tốt.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
