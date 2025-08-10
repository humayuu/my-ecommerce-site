<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    // function cartPage()
    public function AddToCart(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::findOrFail($id);

        if ($product->discount_price == null) {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color
                ]
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {

            $amount = $product->selling_price - $product->discount_price;

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $amount,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color
                ]
            ]);

            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    }


    // Function for get Mini Cart
    public function AddMiniCart()
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

    // Function for Remove Mini Cart
    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart']);
    }

    // Add to Wishlist
    public function AddToWishList(Request $request, $product_id)
    {
        if (Auth::check()) {
            $exits = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->first();

            if (!$exits) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);

                return response()->json(['success' => 'Successfully Add on Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Product has Already on Your Wishlist']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }


    // Function for Apply Coupon
    public function CouponApply(Request $request)
    {
        $coupons = Coupon::where('coupon_name', $request->coupon_name)
            ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
            ->first();
        if ($coupons) {
            Session::put('coupon', [
                'coupon_name' => $coupons->coupon_name,
                'coupon_discount' => $coupons->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupons->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupons->coupon_discount / 100)
            ]);

            return response()->json([
                'success' => 'Coupon Applied Successfully'
            ]);
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    // Function for Coupon Calculation
    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' =>  session()->get('coupon')['total_amount']
            ]);
        } else {
            return response()->json([
                'total' => Cart::total()
            ]);
        }
    }

    // Function for Remove Coupon
    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    // Function for Checkout page
    public function CheckoutCreate()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderby('division_name', 'ASC')->get();

                return  view('frontend.checkout.checkout_view', compact('carts' , 'cartQty' , 'cartTotal' , 'divisions'));
            } else {
                $notification = [
                    'message' => 'Shopping At least one Product',
                    'alert-type' => 'error'
                ];

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = [
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            ];

            return redirect()->route('login')->with($notification);
        }
    }
}
