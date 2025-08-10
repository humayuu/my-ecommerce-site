<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'current_team_id' => null,
            'profile_photo_path' => null,

            'brand' => 1,
            'category' => 1,
            'product' => 1,
            'slider' => 1,
            'coupons' => 1,
            'shipping' => 1,
            'blog' => 1,
            'setting' => 1,
            'return_order' => 1,
            'review' => 1,
            'orders' => 1,
            'stock' => 1,
            'reports' => 1,
            'all_user' => 1,
            'admin_user_role' => 1,
            'type' => 1
        ];
    }
}
