<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('subsubcategory_id');
            $table->string('product_name_en');
            $table->string('product_name_urdu');
            $table->string('product_slug_en');
            $table->string('product_slug_urdu');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags_en');
            $table->string('product_tags_urdu');
            $table->string('product_size_en')->nullable();
            $table->string('product_size_urdu')->nullable();
            $table->string('product_color_en');
            $table->string('product_color_urdu');
            $table->string('selling_price')->nullable();
            $table->string('discount_price');
            $table->string('short_description_en');
            $table->string('short_description_urdu');
            $table->string('long_description_en');
            $table->string('long_description_urdu');
            $table->string('product_thumbnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
