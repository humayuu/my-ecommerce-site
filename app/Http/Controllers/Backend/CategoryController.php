<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Function for Category View
    public function CategoryView()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    // Function for Category Store
    public function CategoryStore(Request $request)
    {
        $request->validate([
            'category_name_en' => 'required',
            'category_name_urdu' => 'required',
            'category_icon' => 'required'
        ], [
            'category_name_en.required' => 'Input Category English Name',
            'category_name_urdu.required' => 'Input Category Urdu Name',
        ]);


        Category::insert([
            'category_name_en' => $request->category_name_en,
            'category_name_urdu' => $request->category_name_urdu,
            'category_icon' => $request->category_icon,

            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_urdu' => str_replace(' ', '-', $request->category_name_urdu),
        ]);

        $notification = [
            'message' => 'Category inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Function for Edit Category
    public function CategoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    // Function for Update Category
    public function CategoryUpdate(Request $request)
    {
        $categoryId = $request->id;

        Category::findOrFail($categoryId)->update([
            'category_name_en' => $request->category_name_en,
            'category_name_urdu' => $request->category_name_urdu,
            'category_icon' => $request->category_icon,

            'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
            'category_slug_urdu' => str_replace(' ', '-', $request->category_name_urdu),
        ]);

        $notification = [
            'message' => 'Category Updated Info',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    // Function for Delete Category
    public function CategoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        $notification = [
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }
}
