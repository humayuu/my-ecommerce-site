<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = [
            ['en' => 'Apple', 'urdu' => 'ایپل'],
            ['en' => 'Samsung', 'urdu' => 'سام سنگ'],
            ['en' => 'Nike', 'urdu' => 'نائیک'],
            ['en' => 'Adidas', 'urdu' => 'ایڈیڈاس'],
            ['en' => 'Sony', 'urdu' => 'سونی'],
            ['en' => 'LG', 'urdu' => 'ایل جی'],
            ['en' => 'Puma', 'urdu' => 'پیوما'],
            ['en' => 'Honda', 'urdu' => 'ہونڈا'],
            ['en' => 'Toyota', 'urdu' => 'ٹویوٹا'],
            ['en' => 'Coca Cola', 'urdu' => 'کوکا کولا'],
            ['en' => 'Pepsi', 'urdu' => 'پیپسی'],
            ['en' => 'McDonalds', 'urdu' => 'میک ڈونلڈز'],
            ['en' => 'KFC', 'urdu' => 'کے ایف سی'],
            ['en' => 'Nestle', 'urdu' => 'نیسلے'],
            ['en' => 'Unilever', 'urdu' => 'یونی لیور'],
            ['en' => 'Procter & Gamble', 'urdu' => 'پراکٹر اینڈ گیمبل'],
            ['en' => 'Johnson & Johnson', 'urdu' => 'جانسن اینڈ جانسن'],
            ['en' => 'Microsoft', 'urdu' => 'مائیکرو سافٹ'],
            ['en' => 'Google', 'urdu' => 'گوگل'],
            ['en' => 'Facebook', 'urdu' => 'فیس بک'],
            ['en' => 'Amazon', 'urdu' => 'ایمیزون'],
            ['en' => 'Dell', 'urdu' => 'ڈیل'],
            ['en' => 'HP', 'urdu' => 'ایچ پی'],
            ['en' => 'Canon', 'urdu' => 'کینن'],
            ['en' => 'Nikon', 'urdu' => 'نکون'],
            ['en' => 'Philips', 'urdu' => 'فلپس'],
            ['en' => 'Panasonic', 'urdu' => 'پیناسونک'],
            ['en' => 'Xiaomi', 'urdu' => 'شیاؤمی'],
            ['en' => 'Huawei', 'urdu' => 'ہواوے'],
            ['en' => 'Oppo', 'urdu' => 'اوپو'],
            ['en' => 'Vivo', 'urdu' => 'ویوو'],
            ['en' => 'Realme', 'urdu' => 'ریل می'],
            ['en' => 'OnePlus', 'urdu' => 'ون پلس'],
            ['en' => 'Lenovo', 'urdu' => 'لینووو'],
            ['en' => 'Acer', 'urdu' => 'ایسر'],
            ['en' => 'Asus', 'urdu' => 'ایسوس'],
            ['en' => 'Intel', 'urdu' => 'انٹل'],
            ['en' => 'AMD', 'urdu' => 'اے ایم ڈی'],
            ['en' => 'Nvidia', 'urdu' => 'اینویڈیا'],
            ['en' => 'Tesla', 'urdu' => 'ٹیسلا'],
        ];

        $brand = $this->faker->randomElement($brands);
        $brandNameEn = $brand['en'];
        $brandNameUrdu = $brand['urdu'];

        return [
            'brand_name_en' => $brandNameEn,
            'brand_name_urdu' => $brandNameUrdu,
            'brand_slug_en' => Str::slug($brandNameEn),
            'brand_slug_urdu' => Str::slug($brandNameUrdu),
            'brand_image' => 'brands/' . Str::slug($brandNameEn) . '.jpg',
        ];
    }
}
