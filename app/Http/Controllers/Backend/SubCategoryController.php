<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    //Function for View Sub Category
    public function SubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::latest()->get();
        return view('backend.category.sub_category_view', compact('subCategories', 'categories'));
    }

    // Function for Store Sub Category
    public function SubCategoryStore(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_urdu' => 'required',
        ], [
            'category_id.required' => 'Please Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory English Name',
            'subcategory_name_urdu.required' => 'Input SubCategory Urdu Name',
        ]);


        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_urdu' => $request->subcategory_name_urdu,

            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_urdu' => str_replace(' ', '-', $request->subcategory_name_urdu),
        ]);

        $notification = [
            'message' => 'SubCategory inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Function for Edit Sub Category
    public function SubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::findOrFail($id);
        return view('backend.category.sub_category_edit', compact('subCategories', 'categories'));
    }

    // Function for Update Sub Category
    public function SubCategoryUpdate(Request $request)
    {
        $subCategory = $request->id;


        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_urdu' => 'required',
        ], [
            'category_id.required' => 'Please Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory English Name',
            'subcategory_name_urdu.required' => 'Input SubCategory Urdu Name',
        ]);


        SubCategory::findOrFail($subCategory)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_urdu' => $request->subcategory_name_urdu,

            'subcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subcategory_name_en)),
            'subcategory_slug_urdu' => str_replace(' ', '-', $request->subcategory_name_urdu),
        ]);

        $notification = [
            'message' => 'SubCategory Update Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    // Function for Delete Sub Category
    public function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }


    // ----------------- Sub Sub Category Starts Here -----------------

    // Function for View Sub Sub Category
    public function SubSubCategoryView()
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subSubcategories = SubSubCategory::latest()->get();
        return view('backend.category.subsub_category_view', compact('subSubcategories', 'categories'));
    }


    // Function for get Sub Category
    public function GetSubCategory($category_id)
    {
        $subCategories = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subCategories);

    }
    // Function for get Sub Sub Category
    public function GetSubSubCategory($subcategory_id)
    {
        $subSubCategories = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subSubCategories);

    }

    // Fuction for Store Sub Sub Category
    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_urdu' => 'required',
        ], [
            'category_id.required' => 'Please Select Any Option',
            'subsubcategory_name_en.required' => 'Input Sub-SubCategory English Name',
            'subsubcategory_name_urdu.required' => 'Input Sub-SubCategory Urdu Name',
        ]);


        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_urdu' => $request->subsubcategory_name_urdu,

            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_urdu' => str_replace(' ', '-', $request->subsubcategory_name_urdu),
        ]);

        $notification = [
            'message' => 'Sub-SubCategory inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }



    // Function for Edit Sub Sub Category
    public function SubSubCategoryEdit($id)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subCategories = SubCategory::orderBy('subcategory_name_en', 'ASC')->get();
        $subSubCategories = SubSubCategory::findOrFail($id);
        return view('backend.category.subsub_category_edit', compact('subCategories', 'categories', 'subSubCategories'));
    }

    // Function for Update Sub Sub Category
    public function SubSubCategoryUpdate(Request $request)
    {
        $subSubCategory = $request->id;

        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_urdu' => 'required',
        ], [
            'category_id.required' => 'Please Select Any Option',
            'subsubcategory_name_en.required' => 'Input Sub-SubCategory English Name',
            'subsubcategory_name_urdu.required' => 'Input Sub-SubCategory Urdu Name',
        ]);

        SubSubCategory::findOrFail($subSubCategory)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_urdu' => $request->subsubcategory_name_urdu,

            'subsubcategory_slug_en' => strtolower(str_replace(' ', '-', $request->subsubcategory_name_en)),
            'subsubcategory_slug_urdu' => str_replace(' ', '-', $request->subsubcategory_name_urdu),
        ]);

        $notification = [
            'message' => 'Sub-SubCategory Update Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('all.subsubcategory')->with($notification);
    }

    // Function for Delete Sub Sub Category
    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = [
            'message' => 'Sub-Sub Category Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }



}
