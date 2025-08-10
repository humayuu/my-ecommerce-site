<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Orderitem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CashController extends Controller
{
    // function for Cash Order
    public function CashOrder(Request $request)
    {
        try {
            // Get total amount
            if (Session::has('coupon')) {
                $totalAmount = Session::get('coupon')['total_amount'];
            } else {
                $totalAmount = round(Cart::total());
            }

            // Validate amount doesn't exceed Stripe's limit
            if ($totalAmount > 999999.99) {
                return back()->with([
                    'message' => 'Order amount exceeds maximum allowed limit',
                    'alert-type' => 'error'
                ]);
            }

            // Create order record
            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_id' => $request->state_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,

                'payment_type' => 'Cash on Delivery',
                'payment_method' => 'Cash on Delivery',
                'currency' => 'USD',
                'amount' => $totalAmount,

                'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]);
            // Start Send Email Add commentMore actions
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_no,
                'amount' => $totalAmount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];

            Mail::to($request->email)->send(new OrderMail($data));

            // End Send Email



            // Create order items
            $carts = Cart::content();
            foreach ($carts as $cart) {
                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color ?? null,
                    'size' => $cart->options->size ?? null,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),
                ]);
            }

            // Clean up session and cart
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            Cart::destroy();

            $notification = [
                'message' => 'Your Order Placed Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('dashboard')->with($notification);
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
