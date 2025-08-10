<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subcategoriesByCategory = [
            'Electronics' => [
                ['en' => 'Smartphones', 'urdu' => 'سمارٹ فونز'],
                ['en' => 'Laptops', 'urdu' => 'لیپ ٹاپ'],
                ['en' => 'Tablets', 'urdu' => 'ٹیبلٹس'],
                ['en' => 'Headphones', 'urdu' => 'ہیڈ فونز'],
                ['en' => 'Smart Watches', 'urdu' => 'سمارٹ واچز'],
            ],
            'Fashion' => [
                ['en' => 'Men\'s Clothing', 'urdu' => 'مردوں کے کپڑے'],
                ['en' => 'Women\'s Clothing', 'urdu' => 'خواتین کے کپڑے'],
                ['en' => 'Shoes', 'urdu' => 'جوتے'],
                ['en' => 'Accessories', 'urdu' => 'لوازمات'],
                ['en' => 'Bags', 'urdu' => 'بیگز'],
            ],
            'Mobile Phones' => [
                ['en' => 'Android Phones', 'urdu' => 'اینڈرائیڈ فونز'],
                ['en' => 'iPhones', 'urdu' => 'آئی فونز'],
                ['en' => 'Mobile Accessories', 'urdu' => 'موبائل لوازمات'],
                ['en' => 'Phone Cases', 'urdu' => 'فون کیسز'],
                ['en' => 'Chargers', 'urdu' => 'چارجرز'],
            ],
            'Home & Garden' => [
                ['en' => 'Furniture', 'urdu' => 'فرنیچر'],
                ['en' => 'Kitchen Appliances', 'urdu' => 'باورچی خانے کے آلات'],
                ['en' => 'Home Decor', 'urdu' => 'گھر کی سجاوٹ'],
                ['en' => 'Gardening Tools', 'urdu' => 'باغبانی کے آلات'],
                ['en' => 'Lighting', 'urdu' => 'روشنی'],
            ],
            'Sports' => [
                ['en' => 'Cricket', 'urdu' => 'کرکٹ'],
                ['en' => 'Football', 'urdu' => 'فٹ بال'],
                ['en' => 'Gym Equipment', 'urdu' => 'جم کا سامان'],
                ['en' => 'Outdoor Sports', 'urdu' => 'بیرونی کھیل'],
                ['en' => 'Sports Shoes', 'urdu' => 'کھیل کے جوتے'],
            ],
        ];

        // Get random category
        $categoryNames = array_keys($subcategoriesByCategory);
        $randomCategoryName = $this->faker->randomElement($categoryNames);
        $subcategories = $subcategoriesByCategory[$randomCategoryName];

        // Get random subcategory
        $subcategory = $this->faker->randomElement($subcategories);
        $subcategoryNameEn = $subcategory['en'];
        $subcategoryNameUrdu = $subcategory['urdu'];

        // Get category ID by name
        $category = Category::where('category_name_en', $randomCategoryName)->first();
        $categoryId = $category ? $category->id : 1; // fallback to 1 if not found

        return [
            'category_id' => $categoryId,
            'subcategory_name_en' => $subcategoryNameEn,
            'subcategory_name_urdu' => $subcategoryNameUrdu,
            'subcategory_slug_en' => Str::slug($subcategoryNameEn),
            'subcategory_slug_urdu' => Str::slug($subcategoryNameUrdu),
        ];
    }
}
