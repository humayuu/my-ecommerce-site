<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserController extends Controller
{
    public function AllAdminRole()
    {
        $adminUser = Admin::where('type', 2)
            ->latest()
            ->get();

        return view('backend.role.admin_role_all', compact('adminUser'));
    }

    public function AddAdminRole()
    {
        return view('backend.role.admin_role_create');
    }

    public function StoreAdminRole(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'profile_photo_path' => 'required'
        ]);

        if ($request->file('profile_photo_path')) {

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('profile_photo_path')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('profile_photo_path'));

            $image = $image->resize(225, 225);

            $image->toJpeg(80)->save(base_path('public/upload/admin_images/' . $nameGen));
            $saveUrl = 'upload/admin_images/' . $nameGen;

            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,
                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'return_order' => $request->return_order,
                'review' => $request->review,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'all_user' => $request->all_user,
                'admin_user_role' => $request->admin_user_role,
                'type' => 2,
                'profile_photo_path' => $saveUrl,
                'created_at' => Carbon::now(),

            ]);
            $notification = [
                'message' => 'Admin User Created Successfully',
                'alert-type' => 'success'
            ];
            return redirect()->route('all-admin-user')->with($notification);
        }
    }

    public function EditAdminRole($id)
    {
        $adminUser = Admin::findOrFail($id);

        return view('backend.role.admin_role_edit', compact('adminUser'));
    }

    public function UpdateAdminRole(Request $request)
    {

        $id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('profile_photo_path')) {

            unlink($old_img);
            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('profile_photo_path')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('profile_photo_path'));

            $image = $image->resize(225, 225);

            $image->toJpeg(80)->save(base_path('public/upload/admin_images/' . $nameGen));
            $saveUrl = 'upload/admin_images/' . $nameGen;

            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'return_order' => $request->return_order,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'all_user' => $request->all_user,
                'admin_user_role' => $request->admin_user_role,
                'type' => 2,
                'profile_photo_path' => $saveUrl,
                'updated_at' => Carbon::now(),

            ]);

            $notification = [
                'message' => 'Admin User Updated Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('all-admin-user')->with($notification);
        } else {

            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,

                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'coupons' => $request->coupons,

                'shipping' => $request->shipping,
                'blog' => $request->blog,
                'setting' => $request->setting,
                'return_order' => $request->return_order,
                'review' => $request->review,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'all_user' => $request->all_user,
                'admin_user_role' => $request->admin_user_role,
                'type' => 2,

                'updated_at' => Carbon::now(),

            ]);

            $notification = [
                'message' => 'Admin User Updated Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('all-admin-user')->with($notification);
        }
    }

    public function DeleteAdminRole($id)
    {
        $admin = Admin::findOrFail($id);
        $image = $admin->profile_photo_path;
        unlink($image);

        Admin::findOrFail($id)->delete();

        $notification = [
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }
}
