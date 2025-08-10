<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('brand')->after('password')->nullable();
            $table->string('category')->after('brand')->nullable();
            $table->string('product')->after('category')->nullable();
            $table->string('slider')->after('product')->nullable();
            $table->string('coupons')->after('slider')->nullable();
            $table->string('shipping')->after('coupons')->nullable();
            $table->string('blog')->after('shipping')->nullable();
            $table->string('setting')->after('blog')->nullable();
            $table->string('return_order')->after('setting')->nullable();
            $table->string('review')->after('return_order')->nullable();
            $table->string('orders')->after('review')->nullable();
            $table->string('stock')->after('orders')->nullable();
            $table->string('reports')->after('stock')->nullable();
            $table->string('all_user')->after('reports')->nullable();
            $table->string('admin_user_role')->after('all_user')->nullable();
            $table->string('type', 25)->after('admin_user_role')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn([
                'brand',
                'category',
                'product',
                'slider',
                'coupons',
                'shipping',
                'blog',
                'setting',
                'return_order',
                'review',
                'orders',
                'stock',
                'reports',
                'all_user',
                'admin_user_role',
                'type'
            ]);
        });
    }
};
