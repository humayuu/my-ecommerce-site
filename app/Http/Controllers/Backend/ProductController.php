<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // Function for Product View
    public function ProductAdd()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('backend.product.product_add', compact('categories', 'brands'));
    }
    // Function for Store Product
    public function ProductStore(Request $request)
    {
        $request->validate(['file' => 'required|mimes:jpeg,jpeg,png,zip,pdf|max:2048']);

        if ($files = $request->file('file')) {
            $destinationPath =  'upload/pdf';
            // if (!is_dir($destinationPath)) {
            //     mkdir($destinationPath, 0755, true);
            // }
            $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $digitalItem);
        }

        if ($request->file('product_thumbnail')) {

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('product_thumbnail'));

            $image = $image->resize(917, 1000);

            $image->toJpeg(80)->save(base_path('public/upload/products/thumbnail/' . $nameGen));
            $saveUrl = 'upload/products/thumbnail/' . $nameGen;

            $productId = Product::insertGetId([

                'brand_id'   => $request->brand_id,

                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'subsubcategory_id' => $request->subsubcategory_id,

                'product_name_en' => $request->product_name_en,
                'product_name_urdu' => $request->product_name_urdu,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_urdu' => strtolower(str_replace(' ', '-', $request->product_name_urdu)),

                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,

                'product_tags_en' => $request->product_tags_en,
                'product_tags_urdu' => $request->product_tags_urdu,
                'product_size_en' => $request->product_size_en,
                'product_size_urdu' => $request->product_size_urdu,
                'product_color_en' => $request->product_color_en,
                'product_color_urdu' => $request->product_color_urdu,

                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,

                'short_description_en' => $request->short_description_en,
                'short_description_urdu' => $request->short_description_urdu,
                'long_description_en' => $request->long_description_en,
                'long_description_urdu' => $request->long_description_urdu,

                'product_thumbnail' => $saveUrl,
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,

                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
                'digital_file' => $digitalItem,

                'status' => 1,
                'created_at' => Carbon::now()
            ]);

            // ---------------------------------- Product Multiple Image ---------------------------------- //


            // Handle Multiple Images
            if ($request->hasFile('multi_image')) {
                foreach ($request->file('multi_image') as $img) {
                    $makeName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension(); // Use $img

                    // Process Image
                    $image = $manager->read($img); // Use $img
                    $image->resize(917, 1000);
                    $image->toJpeg(80)->save(base_path('public/upload/products/multi-images/' . $makeName));
                    $uploadPath = 'upload/products/multi-images/' . $makeName;

                    MultiImage::insert([
                        'product_id' => $productId,
                        'photo_name' => $uploadPath,
                        'created_at' => Carbon::now()
                    ]);
                }
            }

            $notification = [
                'message' => 'Product inserted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('manage-product')->with($notification);
        }
    }


    // Function for Manage Product
    public function ProductManage()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_manage', compact('products'));
    }

    // Function for Edit Product
    public function ProductEdit($id)
    {
        $multiImages = MultiImage::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubcategories = SubSubCategory::latest()->get();

        $products = Product::findOrFail($id);
        $brands = Brand::latest()->get();


        return view('backend.product.product_edit', compact('products', 'categories', 'brands', 'subCategories', 'subSubcategories', 'multiImages'));
    }

    // Function for Update Product
    public function ProductUpdate(Request $request)
    {
        $productId = $request->id;

        Product::findOrFail($productId)->update([

            'brand_id'   => $request->brand_id,

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,

            'product_name_en' => $request->product_name_en,
            'product_name_urdu' => $request->product_name_urdu,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_urdu' => strtolower(str_replace(' ', '-', $request->product_name_urdu)),


            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,

            'product_tags_en' => $request->product_tags_en,
            'product_tags_urdu' => $request->product_tags_urdu,
            'product_size_en' => $request->product_size_en,
            'product_size_urdu' => $request->product_size_urdu,
            'product_color_en' => $request->product_color_en,
            'product_color_urdu' => $request->product_color_urdu,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,

            'short_description_en' => $request->short_description_en,
            'short_description_urdu' => $request->short_description_urdu,
            'long_description_en' => $request->long_description_en,
            'long_description_urdu' => $request->long_description_urdu,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,

            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'updated_at' => Carbon::now()
        ]);


        $notification = [
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('manage-product')->with($notification);
    }

    // Function for Update MultiImage
    public function MultiImageUpdate(Request $request)
    {
        $images = $request->multi_img;

        foreach ($images as $id => $img) {
            $imageDel = MultiImage::findOrFail($id); // Find Image by ID

            // Delete Old Image from Folder (Full Path)
            if (File::exists(public_path($imageDel->photo_name))) {
                unlink(public_path($imageDel->photo_name));
            }

            // Generate New Image Name
            $nameGen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

            // Save Path
            $savePath = public_path('upload/products/multi-images/');

            // Check if Directory Exists, If Not Create It
            if (!File::exists($savePath)) {
                File::makeDirectory($savePath, 0777, true, true);
            }

            // Image Manager Instance
            $makeName = new ImageManager(new Driver());

            // Read and Resize Image
            $image = $makeName->read($img);
            $image = $image->resize(917, 1000);

            // Save Image to Path
            $image->toJpeg(80)->save($savePath . $nameGen);

            $uploadPath = 'upload/products/multi-images/' . $nameGen;

            // Update in Database
            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Product Updated With Image Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }


    // Function for Update Thumbnail image
    public function ThumbnailImageUpdate(Request $request)
    {
        $productId = $request->id;
        $oldImageId = $request->oldImage;
        unlink($oldImageId);

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        $nameGen = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();

        // read image from file system
        $image = $manager->read($request->file('product_thumbnail'));

        $image = $image->resize(917, 1000);

        $image->toJpeg(80)->save(base_path('public/upload/products/thumbnail/' . $nameGen));
        $saveUrl = 'upload/products/thumbnail/' . $nameGen;

        // Update in Database
        Product::findOrFail($productId)->update([
            'product_thumbnail' => $saveUrl,
            'updated_at' => Carbon::now()
        ]);


        $notification = [
            'message' => 'Product Updated With Image Thumbnail Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }


    // Function for Delete Multiple image
    public function ProductMultipleDelete($id)
    {
        $oldImage = MultiImage::findOrFail($id);
        unlink($oldImage->photo_name);
        MultiImage::findOrFail($id)->delete();

        $notification = [
            'message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    // Function for Show Product detail by specific ID
    public function ProductDetail($id)
    {
        $multiImages = MultiImage::where('product_id', $id)->get();
        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $subSubcategories = SubSubCategory::latest()->get();

        $products = Product::findOrFail($id);
        $brands = Brand::latest()->get();


        return view('backend.product.product_detail', compact('products', 'categories', 'brands', 'subCategories', 'subSubcategories', 'multiImages'));
    }


    // Function for Update Status

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        $notification = [
            'message' => 'Product Inactive',
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }



    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = [
            'message' => 'Product Active',
            'alert-type' => 'info'
        ];
        return redirect()->back()->with($notification);
    }


    // Function for Product Delete
    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);

        Product::findOrFail($id)->delete();

        $MultiImages = MultiImage::where('product_id', $id)->get();
        foreach ($MultiImages as $image) {
            unlink($image->photo_name);
            MultiImage::where('product_id', $id)->delete();
        }


        $notification = [
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }


    // Function for Manage Stock
    public function ProductStock()
    {
        $products = Product::latest()
            ->get();
        return view('backend.product.product_stock', compact('products'));
    }
}
