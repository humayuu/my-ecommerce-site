<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_name_en',
        'subsubcategory_name_urdu',
        'subsubcategory_slug_en',
        'subsubcategory_slug_urdu',
    ];


    // Function for Relationship with category table
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Function for Relationship with subcategory table
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
}
