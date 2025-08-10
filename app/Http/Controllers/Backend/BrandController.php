<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    // Function for Show all brand
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_urdu' => 'required',
            'brand_image' => 'required'
        ], [
            'brand_name_en.required' => 'Input Brand English Name',
            'brand_name_urdu.required' => 'Input Brand Urdu Name',
        ]);

        if ($request->file('brand_image')) {

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('brand_image')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('brand_image'));

            $image = $image->resize(300, 300);

            $image->toJpeg(80)->save(base_path('public/upload/brand/' . $nameGen));
            $saveUrl = 'upload/brand/' . $nameGen;

            Brand::insert([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_urdu' => $request->brand_name_urdu,

                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_urdu' => str_replace(' ', '-', $request->brand_name_urdu),
                'brand_image' => $saveUrl
            ]);

            $notification = [
                'message' => 'Brand inserted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request)
    {
        $brandId  = $request->id;
        $oldImage = $request->old_image;

        if ($request->file('brand_image')) {
            // Fixed: Added missing slash and file existence check
            if ($oldImage && file_exists(base_path('public/upload/brand/' . $oldImage))) {
                unlink(base_path('public/upload/brand/' . $oldImage));
            }

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('brand_image')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('brand_image'));

            $image = $image->resize(300, 300);

            $image->toJpeg(80)->save(base_path('public/upload/brand/' . $nameGen));
            $saveUrl = 'upload/brand/' . $nameGen;

            Brand::findOrFail($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_urdu' => $request->brand_name_urdu,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_urdu' => str_replace(' ', '-', $request->brand_name_urdu),
                'brand_image' => $saveUrl
            ]);

            $notification = [
                'message' => 'Brand Updated with Image Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('all.brand')->with($notification);
        } else {

            Brand::findOrFail($brandId)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_urdu' => $request->brand_name_urdu,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_urdu' => str_replace(' ', '-', $request->brand_name_urdu),
                'brand_image' => $oldImage
            ]);

            $notification = [
                'message' => 'Brand Updated without image Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function BrandDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $image = $brand->brand_image;
        unlink($image);

        Brand::findOrFail($id)->delete();

        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }
}
