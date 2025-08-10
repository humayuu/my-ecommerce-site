<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_name_en',
        'subcategory_name_urdu',
        'subcategory_slug_en',
        'subcategory_slug_urdu'
    ];

    // Function for Relationship with category table
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }



}
