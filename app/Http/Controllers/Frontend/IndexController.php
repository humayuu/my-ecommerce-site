<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    // Function for Redirect Home
    public function index()
    {
        $blogPost = BlogPost::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featured = Product::where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hotDeals = Product::where('hot_deals', 1)->where('discount_price', '!=', null)->orderBy('id', 'DESC')->limit(6)->get();
        $specialOffer = Product::where('special_offer', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $specialDeals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $skipCategory1 = Category::skip(0)->first();
        $skipProduct1 = Product::where('status', 1)->where('category_id', $skipCategory1->id)->orderBy('id', 'DESC')->get();

        $skipCategory2 = Category::skip(1)->first();
        $skipProduct2 = Product::where('status', 1)->where('category_id', $skipCategory2->id)->orderBy('id', 'DESC')->get();

        $skipBrand = Brand::skip(0)->first();
        $skipBrandProduct = Product::where('status', 1)->where('brand_id', $skipBrand->id)->orderBy('id', 'DESC')->get();

        return view('frontend.index', compact('categories', 'sliders', 'products', 'featured', 'hotDeals', 'specialOffer', 'specialDeals', 'skipCategory1', 'skipProduct1', 'skipCategory2', 'skipProduct2', 'skipBrand', 'skipBrandProduct', 'blogPost'));
    }


    // Function for User Logout
    public function UserLogout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    // Function for Update User Profile
    public function UserProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('frontend.profile.user_profile', compact('user'));
    }

    public function UserProfileStore(Request $request)
    {
        $userData = User::find(Auth::user()->id);
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            unlink(public_path('upload/user_images/' . $userData->profile_photo_path));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $userData['profile_photo_path'] = $fileName;
        }

        $userData->save();


        $notification = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);
    }

    // Function for User Change Password
    public function UserChangePassword()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = User::find(Auth::user()->id)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = User::find(Auth::user()->id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }


    // Function For Product Details View In Frontend
    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $colorEnglish = $product->product_color_en;
        $productColorEnglish = explode(',', $colorEnglish);

        $colorUrdu = $product->product_color_urdu;
        $productColorUrdu = explode(',', $colorUrdu);


        $sizeEnglish = $product->product_size_en;
        $productSizeEnglish = explode(',', $sizeEnglish);

        $sizeUrdu = $product->product_size_urdu;
        $productSizeUrdu = explode(',', $sizeUrdu);

        $multiImages = MultiImage::where('product_id', $id)->get();

        $categoryId = $product->category_id;
        $relatedProduct = Product::where('category_id', $categoryId)
            ->where('id', '!=', $id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.product.product_details', compact('product', 'multiImages', 'productColorEnglish', 'productColorUrdu', 'productSizeEnglish', 'productSizeUrdu', 'relatedProduct'));
    }

    // Function for Show Tags wise Product
    public function TagWiseProduct($tag)
    {
        $products = Product::where('status', 1)
            ->where('product_tags_en', $tag)
            ->where('product_tags_urdu', $tag)
            ->orderBy('id', 'DESC')
            ->paginate(2);
        $categories = Category::orderby('category_name_en', 'ASC')->get();
        return view('frontend.tags.tags_view', compact('products', 'categories'));
    }


    // Function for SubCategory Wise Product
    public function SubCategoryWiseProduct(Request $request, $sub_id, $slug)
    {
        $products = Product::where('status', 1)
            ->where('subcategory_id', $sub_id)
            ->orderby('id', 'DESC')
            ->paginate(3);
        $categories = Category::orderby('category_name_en', 'ASC')->get();
        $breadSubCategories = SubCategory::with(['category'])->where('id', $sub_id)->get();

        // Load More Product with Ajax
        if ($request->ajax()) {
            $guredView = view('frontend.product.gured_view_product', compact('products'))
                ->render();
            $listView = view('frontend.product.list_view_product', compact('products'))
                ->render();

            return response()->json(['guredView' => $guredView, 'listView', $listView]);
        }

        return view('frontend.product.subcategory_view', compact('products', 'categories', 'breadSubCategories'));
    }

    // Function for Sub-SubCategory Wise Product
    public function subSubCategoryWiseProduct($subsub_id, $slug)
    {
        $products = Product::where('status', 1)
            ->where('subsubcategory_id', $subsub_id)
            ->orderby('id', 'DESC')
            ->paginate(6);
        $categories = Category::orderby('category_name_en', 'ASC')->get();
        return view('frontend.product.subsubcategory_view', compact('products', 'categories'));
    }


    // Function for Product View with Ajax
    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')
            ->findOrFail($id);

        $color = $product->product_color_en;
        $productColor = explode(',', $color);

        $size = $product->product_size_en;
        $productSize = explode(',', $size);

        return response()->json([
            'product' => $product,
            'color' => $productColor,
            'size' => $productSize

        ]);
    }

    // Function for Search Product
    public function ProductSearch(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $search = $request->search;

        $products = Product::where('product_name_en', 'LIKE', "%$search%")
            ->get();
        $categories = Category::orderby('category_name_en', 'ASC')->get();

        return view('frontend.product.search', compact('products', 'categories'));
    }

    public function AdvanceProductSearch(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);
        $search = $request->search;

        $products = Product::where('product_name_en', 'LIKE', "%$search%")
            ->select('product_name_en', 'product_thumbnail', 'selling_price', 'id', 'product_slug_en')
            ->limit(5)
            ->get();

        return view('frontend.product.search_product', compact('products'));
    }
}
