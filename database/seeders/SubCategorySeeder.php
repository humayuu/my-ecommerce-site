<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all categories
        $electronics = Category::where('category_slug_en', 'electronics')->first();
        $fashion = Category::where('category_slug_en', 'fashion')->first();
        $mobilePhones = Category::where('category_slug_en', 'mobile-phones')->first();
        $homeGarden = Category::where('category_slug_en', 'home-garden')->first();
        $sports = Category::where('category_slug_en', 'sports')->first();

        // Create subcategories for each category
        $subcategories = [
            // Electronics subcategories
            [
                'category_id' => $electronics?->id ?? 1,
                'subcategory_name_en' => 'Smartphones',
                'subcategory_name_urdu' => 'سمارٹ فونز',
                'subcategory_slug_en' => 'smartphones',
                'subcategory_slug_urdu' => 'سمارٹ-فونز',
            ],
            [
                'category_id' => $electronics?->id ?? 1,
                'subcategory_name_en' => 'Laptops',
                'subcategory_name_urdu' => 'لیپ ٹاپ',
                'subcategory_slug_en' => 'laptops',
                'subcategory_slug_urdu' => 'لیپ-ٹاپ',
            ],
            [
                'category_id' => $electronics?->id ?? 1,
                'subcategory_name_en' => 'Headphones',
                'subcategory_name_urdu' => 'ہیڈ فونز',
                'subcategory_slug_en' => 'headphones',
                'subcategory_slug_urdu' => 'ہیڈ-فونز',
            ],

            // Fashion subcategories
            [
                'category_id' => $fashion?->id ?? 2,
                'subcategory_name_en' => 'Men\'s Clothing',
                'subcategory_name_urdu' => 'مردوں کے کپڑے',
                'subcategory_slug_en' => 'mens-clothing',
                'subcategory_slug_urdu' => 'مردوں-کے-کپڑے',
            ],
            [
                'category_id' => $fashion?->id ?? 2,
                'subcategory_name_en' => 'Women\'s Clothing',
                'subcategory_name_urdu' => 'خواتین کے کپڑے',
                'subcategory_slug_en' => 'womens-clothing',
                'subcategory_slug_urdu' => 'خواتین-کے-کپڑے',
            ],
            [
                'category_id' => $fashion?->id ?? 2,
                'subcategory_name_en' => 'Shoes',
                'subcategory_name_urdu' => 'جوتے',
                'subcategory_slug_en' => 'shoes',
                'subcategory_slug_urdu' => 'جوتے',
            ],

            // Mobile Phones subcategories
            [
                'category_id' => $mobilePhones?->id ?? 3,
                'subcategory_name_en' => 'Android Phones',
                'subcategory_name_urdu' => 'اینڈرائیڈ فونز',
                'subcategory_slug_en' => 'android-phones',
                'subcategory_slug_urdu' => 'اینڈرائیڈ-فونز',
            ],
            [
                'category_id' => $mobilePhones?->id ?? 3,
                'subcategory_name_en' => 'iPhones',
                'subcategory_name_urdu' => 'آئی فونز',
                'subcategory_slug_en' => 'iphones',
                'subcategory_slug_urdu' => 'آئی-فونز',
            ],
            [
                'category_id' => $mobilePhones?->id ?? 3,
                'subcategory_name_en' => 'Mobile Accessories',
                'subcategory_name_urdu' => 'موبائل لوازمات',
                'subcategory_slug_en' => 'mobile-accessories',
                'subcategory_slug_urdu' => 'موبائل-لوازمات',
            ],

            // Home & Garden subcategories
            [
                'category_id' => $homeGarden?->id ?? 4,
                'subcategory_name_en' => 'Furniture',
                'subcategory_name_urdu' => 'فرنیچر',
                'subcategory_slug_en' => 'furniture',
                'subcategory_slug_urdu' => 'فرنیچر',
            ],
            [
                'category_id' => $homeGarden?->id ?? 4,
                'subcategory_name_en' => 'Kitchen Appliances',
                'subcategory_name_urdu' => 'باورچی خانے کے آلات',
                'subcategory_slug_en' => 'kitchen-appliances',
                'subcategory_slug_urdu' => 'باورچی-خانے-کے-آلات',
            ],
            [
                'category_id' => $homeGarden?->id ?? 4,
                'subcategory_name_en' => 'Home Decor',
                'subcategory_name_urdu' => 'گھر کی سجاوٹ',
                'subcategory_slug_en' => 'home-decor',
                'subcategory_slug_urdu' => 'گھر-کی-سجاوٹ',
            ],

            // Sports subcategories
            [
                'category_id' => $sports?->id ?? 5,
                'subcategory_name_en' => 'Cricket',
                'subcategory_name_urdu' => 'کرکٹ',
                'subcategory_slug_en' => 'cricket',
                'subcategory_slug_urdu' => 'کرکٹ',
            ],
            [
                'category_id' => $sports?->id ?? 5,
                'subcategory_name_en' => 'Football',
                'subcategory_name_urdu' => 'فٹ بال',
                'subcategory_slug_en' => 'football',
                'subcategory_slug_urdu' => 'فٹ-بال',
            ],
            [
                'category_id' => $sports?->id ?? 5,
                'subcategory_name_en' => 'Gym Equipment',
                'subcategory_name_urdu' => 'جم کا سامان',
                'subcategory_slug_en' => 'gym-equipment',
                'subcategory_slug_urdu' => 'جم-کا-سامان',
            ],
        ];

        // Insert subcategories
        foreach ($subcategories as $subcategory) {
            SubCategory::updateOrCreate(
                ['subcategory_slug_en' => $subcategory['subcategory_slug_en']],
                $subcategory
            );
        }
    }
}
