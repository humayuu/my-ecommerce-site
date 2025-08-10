<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 specific categories with predefined data
        $specificCategories = [
            [
                'category_name_en' => 'Electronics',
                'category_name_urdu' => 'الیکٹرانکس',
                'category_slug_en' => 'electronics',
                'category_slug_urdu' => 'الیکٹرانکس',
                'category_icon' => 'fas fa-laptop',
            ],
            [
                'category_name_en' => 'Fashion',
                'category_name_urdu' => 'فیشن',
                'category_slug_en' => 'fashion',
                'category_slug_urdu' => 'فیشن',
                'category_icon' => 'fas fa-tshirt',
            ],
            [
                'category_name_en' => 'Mobile Phones',
                'category_name_urdu' => 'موبائل فون',
                'category_slug_en' => 'mobile-phones',
                'category_slug_urdu' => 'موبائل-فون',
                'category_icon' => 'fas fa-mobile-alt',
            ],
            [
                'category_name_en' => 'Home & Garden',
                'category_name_urdu' => 'گھر اور باغ',
                'category_slug_en' => 'home-garden',
                'category_slug_urdu' => 'گھر-اور-باغ',
                'category_icon' => 'fas fa-home',
            ],
            [
                'category_name_en' => 'Sports',
                'category_name_urdu' => 'کھیل',
                'category_slug_en' => 'sports',
                'category_slug_urdu' => 'کھیل',
                'category_icon' => 'fas fa-football-ball',
            ]
        ];

        // Insert specific categories
        foreach ($specificCategories as $category) {
            Category::updateOrCreate(
                ['category_slug_en' => $category['category_slug_en']],
                $category
            );
        }
    }
}
