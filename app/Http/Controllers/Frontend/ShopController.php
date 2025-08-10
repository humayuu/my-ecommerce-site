<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
    public function ShopPage()
    {
        $products = Product::query();
        if (!empty($_GET['category'])) {
            $slug = explode(',', $_GET['category']);
            $catId = Category::select('id')
                ->whereIn('category_slug_en', $slug)
                ->pluck('id')
                ->toArray();

            $products = $products->whereIn('category_id', $catId)
                ->paginate(3);

            if (!empty($_GET['brand'])) {
                $slugs = explode(',', $_GET['brand']);
                $brandIds = Brand::select('id')->whereIn('brand_slug_en', $slugs)->pluck('id')->toArray();
                $products = $products->whereIn('brand_id', $brandIds)->paginate(3);
            }
        } else {
            $products = Product::where('status', 1)
                ->orderby('id', 'DESC')
                ->paginate(3);
        }
        $brands = Brand::orderby('brand_name_en', 'ASC')
            ->get();
        $categories = Category::orderby('category_name_en', 'ASC')
            ->get();
        return view('frontend.shop.shop_page', compact('products', 'categories', 'brands'));
    }

    public function ShopFilter(Request $request)
    {
        $data = $request->all();

        // Filter Category
        $categoryUrl = '';

        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($categoryUrl)) {
                    $categoryUrl .= '&category=' . $category;
                } else {
                    $categoryUrl .= ',' . $category;
                }
            }
        }

        // Filter Brand
        $brandUrl = '';

        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }


        return redirect()->route('shop-page', $categoryUrl.$brandUrl);

    }
}

