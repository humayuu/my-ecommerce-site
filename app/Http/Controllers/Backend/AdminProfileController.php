<?php

namespace App\Http\Controllers\Backend;


use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    // Function to show all data on the Admin Profile Page
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileEdit()
    {
        $id = Auth::user()->id;

        $editData = Admin::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }


    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $adminData = Admin::find($id);
        $adminData->name = $request->name;
        $adminData->email = $request->email;

        if ($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            // unlink(public_path('upload/admin_images/' . $adminData->profile_photo_path));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $adminData['profile_photo_path'] = $fileName;
        }

        $adminData->save();


        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }


    public function AdminUpdateChangePassword(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $id = Auth::user()->id;
        $hashedPassword = Admin::find($id)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::find($id);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();

            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    }
}
