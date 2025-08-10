<?php

namespace App\Http\Controllers\User;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    // Function Cart
    public function MyCart()
    {
        return view('frontend.wishlist.view_mycart');
    }

    public function GetCartProduct()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();

        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal)
        ]);
    }

    // Function for Remove Cart Product
    public function RemoveCartProduct($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Successfully Remove From Cart']);
    }

    // Function for Cart Increment
    public function CartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupons = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupons->coupon_name,
                'coupon_discount' => $coupons->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupons->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupons->coupon_discount / 100)
            ]);
        }
        return response()->json('increment');
    }

    // Function for Cart Decrement
    public function CartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupons = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupons->coupon_name,
                'coupon_discount' => $coupons->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupons->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupons->coupon_discount / 100)
            ]);
        }

        return response()->json('Decrement');
    }
}
