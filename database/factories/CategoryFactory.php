<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['en' => 'Electronics', 'urdu' => 'الیکٹرانکس', 'icon' => 'fas fa-laptop'],
            ['en' => 'Fashion', 'urdu' => 'فیشن', 'icon' => 'fas fa-tshirt'],
            ['en' => 'Home & Garden', 'urdu' => 'گھر اور باغ', 'icon' => 'fas fa-home'],
            ['en' => 'Sports', 'urdu' => 'کھیل', 'icon' => 'fas fa-football-ball'],
            ['en' => 'Books', 'urdu' => 'کتابیں', 'icon' => 'fas fa-book'],
            ['en' => 'Toys', 'urdu' => 'کھلونے', 'icon' => 'fas fa-gamepad'],
            ['en' => 'Health & Beauty', 'urdu' => 'صحت اور خوبصورتی', 'icon' => 'fas fa-heart'],
            ['en' => 'Automotive', 'urdu' => 'گاڑیاں', 'icon' => 'fas fa-car'],
            ['en' => 'Food & Beverages', 'urdu' => 'کھانا پینا', 'icon' => 'fas fa-utensils'],
            ['en' => 'Mobile Phones', 'urdu' => 'موبائل فون', 'icon' => 'fas fa-mobile-alt'],
            ['en' => 'Computers', 'urdu' => 'کمپیوٹر', 'icon' => 'fas fa-desktop'],
            ['en' => 'Cameras', 'urdu' => 'کیمرے', 'icon' => 'fas fa-camera'],
            ['en' => 'Shoes', 'urdu' => 'جوتے', 'icon' => 'fas fa-shoe-prints'],
            ['en' => 'Bags', 'urdu' => 'بیگ', 'icon' => 'fas fa-shopping-bag'],
            ['en' => 'Watches', 'urdu' => 'گھڑیاں', 'icon' => 'fas fa-clock'],
            ['en' => 'Jewelry', 'urdu' => 'زیورات', 'icon' => 'fas fa-gem'],
            ['en' => 'Furniture', 'urdu' => 'فرنیچر', 'icon' => 'fas fa-couch'],
            ['en' => 'Kitchen', 'urdu' => 'باورچی خانہ', 'icon' => 'fas fa-kitchen-set'],
            ['en' => 'Baby Products', 'urdu' => 'بچوں کا سامان', 'icon' => 'fas fa-baby'],
            ['en' => 'Office Supplies', 'urdu' => 'دفتری سامان', 'icon' => 'fas fa-briefcase'],
        ];

        $category = $this->faker->randomElement($categories);
        $categoryNameEn = $category['en'];
        $categoryNameUrdu = $category['urdu'];
        $categoryIcon = $category['icon'];

        return [
            'category_name_en' => $categoryNameEn,
            'category_name_urdu' => $categoryNameUrdu,
            'category_slug_en' => Str::slug($categoryNameEn),
            'category_slug_urdu' => Str::slug($categoryNameUrdu),
            'category_icon' => $categoryIcon,
        ];
    }
}
