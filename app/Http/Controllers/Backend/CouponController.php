<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    // Function for View All Coupons
    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')
            ->get();
        return view('backend.coupon.view_coupon', compact('coupons'));
    }

    // Function for Store Coupon
    public function CouponStore(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required'
        ]);


        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Coupon inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    //Function for Edit Coupon
    public function CouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }

    // Function for Update Coupon
    public function CouponUpdate(Request $request, $id)
    {
        Coupon::findOrFail($id)
        ->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage-coupons')->with($notification);
    }

    // Function for Delete Coupon
    public function CouponDelete($id){
         Coupon::findOrFail($id)->delete();

        $notification = [
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }
}
