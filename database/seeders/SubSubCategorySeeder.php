<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubSubCategory;
use App\Models\Category;
use App\Models\SubCategory;

class SubSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get subcategories with their relationships
        $smartphones = SubCategory::where('subcategory_slug_en', 'smartphones')->first();
        $laptops = SubCategory::where('subcategory_slug_en', 'laptops')->first();
        $mensClothing = SubCategory::where('subcategory_slug_en', 'mens-clothing')->first();
        $womensClothing = SubCategory::where('subcategory_slug_en', 'womens-clothing')->first();
        $androidPhones = SubCategory::where('subcategory_slug_en', 'android-phones')->first();
        $iphones = SubCategory::where('subcategory_slug_en', 'iphones')->first();
        $furniture = SubCategory::where('subcategory_slug_en', 'furniture')->first();
        $cricket = SubCategory::where('subcategory_slug_en', 'cricket')->first();

        // Create sub-subcategories
        $subSubCategories = [
            // Smartphones sub-subcategories
            [
                'category_id' => $smartphones?->category_id ?? 1,
                'subcategory_id' => $smartphones?->id ?? 1,
                'subsubcategory_name_en' => 'Android Smartphones',
                'subsubcategory_name_urdu' => 'اینڈرائیڈ سمارٹ فونز',
                'subsubcategory_slug_en' => 'android-smartphones',
                'subsubcategory_slug_urdu' => 'اینڈرائیڈ-سمارٹ-فونز',
            ],
            [
                'category_id' => $smartphones?->category_id ?? 1,
                'subcategory_id' => $smartphones?->id ?? 1,
                'subsubcategory_name_en' => 'Gaming Phones',
                'subsubcategory_name_urdu' => 'گیمنگ فونز',
                'subsubcategory_slug_en' => 'gaming-phones',
                'subsubcategory_slug_urdu' => 'گیمنگ-فونز',
            ],

            // Laptops sub-subcategories
            [
                'category_id' => $laptops?->category_id ?? 1,
                'subcategory_id' => $laptops?->id ?? 2,
                'subsubcategory_name_en' => 'Gaming Laptops',
                'subsubcategory_name_urdu' => 'گیمنگ لیپ ٹاپ',
                'subsubcategory_slug_en' => 'gaming-laptops',
                'subsubcategory_slug_urdu' => 'گیمنگ-لیپ-ٹاپ',
            ],
            [
                'category_id' => $laptops?->category_id ?? 1,
                'subcategory_id' => $laptops?->id ?? 2,
                'subsubcategory_name_en' => 'Business Laptops',
                'subsubcategory_name_urdu' => 'بزنس لیپ ٹاپ',
                'subsubcategory_slug_en' => 'business-laptops',
                'subsubcategory_slug_urdu' => 'بزنس-لیپ-ٹاپ',
            ],

            // Men's Clothing sub-subcategories
            [
                'category_id' => $mensClothing?->category_id ?? 2,
                'subcategory_id' => $mensClothing?->id ?? 4,
                'subsubcategory_name_en' => 'Shirts',
                'subsubcategory_name_urdu' => 'قمیص',
                'subsubcategory_slug_en' => 'shirts',
                'subsubcategory_slug_urdu' => 'قمیص',
            ],
            [
                'category_id' => $mensClothing?->category_id ?? 2,
                'subcategory_id' => $mensClothing?->id ?? 4,
                'subsubcategory_name_en' => 'T-Shirts',
                'subsubcategory_name_urdu' => 'ٹی شرٹس',
                'subsubcategory_slug_en' => 't-shirts',
                'subsubcategory_slug_urdu' => 'ٹی-شرٹس',
            ],

            // Women's Clothing sub-subcategories
            [
                'category_id' => $womensClothing?->category_id ?? 2,
                'subcategory_id' => $womensClothing?->id ?? 5,
                'subsubcategory_name_en' => 'Dresses',
                'subsubcategory_name_urdu' => 'فراک',
                'subsubcategory_slug_en' => 'dresses',
                'subsubcategory_slug_urdu' => 'فراک',
            ],
            [
                'category_id' => $womensClothing?->category_id ?? 2,
                'subcategory_id' => $womensClothing?->id ?? 5,
                'subsubcategory_name_en' => 'Blouses',
                'subsubcategory_name_urdu' => 'بلاؤز',
                'subsubcategory_slug_en' => 'blouses',
                'subsubcategory_slug_urdu' => 'بلاؤز',
            ],

            // Android Phones sub-subcategories
            [
                'category_id' => $androidPhones?->category_id ?? 3,
                'subcategory_id' => $androidPhones?->id ?? 7,
                'subsubcategory_name_en' => 'Samsung Galaxy',
                'subsubcategory_name_urdu' => 'سام سنگ گیلکسی',
                'subsubcategory_slug_en' => 'samsung-galaxy',
                'subsubcategory_slug_urdu' => 'سام-سنگ-گیلکسی',
            ],
            [
                'category_id' => $androidPhones?->category_id ?? 3,
                'subcategory_id' => $androidPhones?->id ?? 7,
                'subsubcategory_name_en' => 'Xiaomi Phones',
                'subsubcategory_name_urdu' => 'شیاؤمی فونز',
                'subsubcategory_slug_en' => 'xiaomi-phones',
                'subsubcategory_slug_urdu' => 'شیاؤمی-فونز',
            ],

            // iPhones sub-subcategories
            [
                'category_id' => $iphones?->category_id ?? 3,
                'subcategory_id' => $iphones?->id ?? 8,
                'subsubcategory_name_en' => 'iPhone 15 Series',
                'subsubcategory_name_urdu' => 'آئی فون 15 سیریز',
                'subsubcategory_slug_en' => 'iphone-15-series',
                'subsubcategory_slug_urdu' => 'آئی-فون-15-سیریز',
            ],
            [
                'category_id' => $iphones?->category_id ?? 3,
                'subcategory_id' => $iphones?->id ?? 8,
                'subsubcategory_name_en' => 'iPhone 14 Series',
                'subsubcategory_name_urdu' => 'آئی فون 14 سیریز',
                'subsubcategory_slug_en' => 'iphone-14-series',
                'subsubcategory_slug_urdu' => 'آئی-فون-14-سیریز',
            ],

            // Furniture sub-subcategories
            [
                'category_id' => $furniture?->category_id ?? 4,
                'subcategory_id' => $furniture?->id ?? 10,
                'subsubcategory_name_en' => 'Sofas',
                'subsubcategory_name_urdu' => 'صوفے',
                'subsubcategory_slug_en' => 'sofas',
                'subsubcategory_slug_urdu' => 'صوفے',
            ],
            [
                'category_id' => $furniture?->category_id ?? 4,
                'subcategory_id' => $furniture?->id ?? 10,
                'subsubcategory_name_en' => 'Beds',
                'subsubcategory_name_urdu' => 'بستر',
                'subsubcategory_slug_en' => 'beds',
                'subsubcategory_slug_urdu' => 'بستر',
            ],

            // Cricket sub-subcategories
            [
                'category_id' => $cricket?->category_id ?? 5,
                'subcategory_id' => $cricket?->id ?? 13,
                'subsubcategory_name_en' => 'Cricket Bats',
                'subsubcategory_name_urdu' => 'کرکٹ بیٹ',
                'subsubcategory_slug_en' => 'cricket-bats',
                'subsubcategory_slug_urdu' => 'کرکٹ-بیٹ',
            ],
            [
                'category_id' => $cricket?->category_id ?? 5,
                'subcategory_id' => $cricket?->id ?? 13,
                'subsubcategory_name_en' => 'Cricket Balls',
                'subsubcategory_name_urdu' => 'کرکٹ گیند',
                'subsubcategory_slug_en' => 'cricket-balls',
                'subsubcategory_slug_urdu' => 'کرکٹ-گیند',
            ],
        ];

        // Insert sub-subcategories
        foreach ($subSubCategories as $subSubCategory) {
            SubSubCategory::updateOrCreate(
                ['subsubcategory_slug_en' => $subSubCategory['subsubcategory_slug_en']],
                $subSubCategory
            );
        }
    }
}
