<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubSubCategory>
 */
class SubSubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subSubCategoriesBySubCategory = [
            'Smartphones' => [
                ['en' => 'Android Smartphones', 'urdu' => 'اینڈرائیڈ سمارٹ فونز'],
                ['en' => 'iPhone', 'urdu' => 'آئی فون'],
                ['en' => 'Gaming Phones', 'urdu' => 'گیمنگ فونز'],
            ],
            'Laptops' => [
                ['en' => 'Gaming Laptops', 'urdu' => 'گیمنگ لیپ ٹاپ'],
                ['en' => 'Business Laptops', 'urdu' => 'بزنس لیپ ٹاپ'],
                ['en' => 'Ultrabooks', 'urdu' => 'الٹرا بکس'],
            ],
            'Headphones' => [
                ['en' => 'Wireless Headphones', 'urdu' => 'وائرلیس ہیڈ فونز'],
                ['en' => 'Wired Headphones', 'urdu' => 'وائرڈ ہیڈ فونز'],
                ['en' => 'Earbuds', 'urdu' => 'ایئر بڈز'],
            ],
            'Men\'s Clothing' => [
                ['en' => 'Shirts', 'urdu' => 'قمیص'],
                ['en' => 'T-Shirts', 'urdu' => 'ٹی شرٹس'],
                ['en' => 'Pants', 'urdu' => 'پتلون'],
            ],
            'Women\'s Clothing' => [
                ['en' => 'Dresses', 'urdu' => 'فراک'],
                ['en' => 'Blouses', 'urdu' => 'بلاؤز'],
                ['en' => 'Skirts', 'urdu' => 'اسکرٹس'],
            ],
            'Shoes' => [
                ['en' => 'Sneakers', 'urdu' => 'اسنیکرز'],
                ['en' => 'Formal Shoes', 'urdu' => 'فارمل جوتے'],
                ['en' => 'Sandals', 'urdu' => 'سینڈل'],
            ],
            'Android Phones' => [
                ['en' => 'Samsung Galaxy', 'urdu' => 'سام سنگ گیلکسی'],
                ['en' => 'Xiaomi Phones', 'urdu' => 'شیاؤمی فونز'],
                ['en' => 'OnePlus Phones', 'urdu' => 'ون پلس فونز'],
            ],
            'iPhones' => [
                ['en' => 'iPhone 15 Series', 'urdu' => 'آئی فون 15 سیریز'],
                ['en' => 'iPhone 14 Series', 'urdu' => 'آئی فون 14 سیریز'],
                ['en' => 'iPhone 13 Series', 'urdu' => 'آئی فون 13 سیریز'],
            ],
            'Mobile Accessories' => [
                ['en' => 'Phone Cases', 'urdu' => 'فون کیسز'],
                ['en' => 'Screen Protectors', 'urdu' => 'اسکرین پروٹیکٹرز'],
                ['en' => 'Power Banks', 'urdu' => 'پاور بینکس'],
            ],
            'Furniture' => [
                ['en' => 'Sofas', 'urdu' => 'صوفے'],
                ['en' => 'Beds', 'urdu' => 'بستر'],
                ['en' => 'Chairs', 'urdu' => 'کرسیاں'],
            ],
            'Kitchen Appliances' => [
                ['en' => 'Refrigerators', 'urdu' => 'ریفریجریٹر'],
                ['en' => 'Microwaves', 'urdu' => 'مائیکرو ویو'],
                ['en' => 'Blenders', 'urdu' => 'بلینڈرز'],
            ],
            'Home Decor' => [
                ['en' => 'Wall Art', 'urdu' => 'دیوار کی سجاوٹ'],
                ['en' => 'Curtains', 'urdu' => 'پردے'],
                ['en' => 'Rugs', 'urdu' => 'قالین'],
            ],
            'Cricket' => [
                ['en' => 'Cricket Bats', 'urdu' => 'کرکٹ بیٹ'],
                ['en' => 'Cricket Balls', 'urdu' => 'کرکٹ گیند'],
                ['en' => 'Cricket Pads', 'urdu' => 'کرکٹ پیڈز'],
            ],
            'Football' => [
                ['en' => 'Football Boots', 'urdu' => 'فٹ بال بوٹس'],
                ['en' => 'Footballs', 'urdu' => 'فٹ بال گیندیں'],
                ['en' => 'Football Jerseys', 'urdu' => 'فٹ بال جرسی'],
            ],
            'Gym Equipment' => [
                ['en' => 'Dumbbells', 'urdu' => 'ڈمبلز'],
                ['en' => 'Treadmills', 'urdu' => 'ٹریڈ ملز'],
                ['en' => 'Exercise Bikes', 'urdu' => 'ایکسرسائز بائیکس'],
            ],
        ];

        // Get random subcategory
        $subcategoryNames = array_keys($subSubCategoriesBySubCategory);
        $randomSubCategoryName = $this->faker->randomElement($subcategoryNames);
        $subSubCategories = $subSubCategoriesBySubCategory[$randomSubCategoryName];

        // Get random sub-subcategory
        $subSubCategory = $this->faker->randomElement($subSubCategories);
        $subSubCategoryNameEn = $subSubCategory['en'];
        $subSubCategoryNameUrdu = $subSubCategory['urdu'];

        // Get subcategory and category IDs
        $subCategory = SubCategory::where('subcategory_name_en', $randomSubCategoryName)->first();
        $subCategoryId = $subCategory ? $subCategory->id : 1;
        $categoryId = $subCategory ? $subCategory->category_id : 1;

        return [
            'category_id' => $categoryId,
            'subcategory_id' => $subCategoryId,
            'subsubcategory_name_en' => $subSubCategoryNameEn,
            'subsubcategory_name_urdu' => $subSubCategoryNameUrdu,
            'subsubcategory_slug_en' => Str::slug($subSubCategoryNameEn),
            'subsubcategory_slug_urdu' => Str::slug($subSubCategoryNameUrdu),
        ];
    }
}
