<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create only 5 specific brands with predefined data
        $specificBrands = [
            [
                'brand_name_en' => 'Apple',
                'brand_name_urdu' => 'ایپل',
                'brand_slug_en' => 'apple',
                'brand_slug_urdu' => 'ایپل',
                'brand_image' => 'image',
            ],
            [
                'brand_name_en' => 'Samsung',
                'brand_name_urdu' => 'سام سنگ',
                'brand_slug_en' => 'samsung',
                'brand_slug_urdu' => 'سام-سنگ',
                'brand_image' => 'image',
            ],
            [
                'brand_name_en' => 'Nike',
                'brand_name_urdu' => 'نائیک',
                'brand_slug_en' => 'nike',
                'brand_slug_urdu' => 'نائیک',
                'brand_image' => 'image',
            ],
            [
                'brand_name_en' => 'Adidas',
                'brand_name_urdu' => 'ایڈیڈاس',
                'brand_slug_en' => 'adidas',
                'brand_slug_urdu' => 'ایڈیڈاس',
                'brand_image' => 'image',
            ],
            [
                'brand_name_en' => 'Sony',
                'brand_name_urdu' => 'سونی',
                'brand_slug_en' => 'sony',
                'brand_slug_urdu' => 'سونی',
                'brand_image' => 'image',
            ]
        ];

        // Insert specific brands
        foreach ($specificBrands as $brand) {
            Brand::updateOrCreate(
                ['brand_slug_en' => $brand['brand_slug_en']],
                $brand
            );
        }
    }
}
