<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function MyOrder()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderby('id', 'DESC')
            ->get();

        return view('frontend.user.order.order_view', compact('orders'));
    }


    public function OrderDetails($order_id)
    {

        $order = Order::with('division', 'district', 'state', 'user')
            ->where('id', $order_id)
            ->where('user_id', Auth::id())
            ->first();

        $orderItem = OrderItem::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();


        return view('frontend.user.order.order_details', compact('order', 'orderItem'));
    }
    public function InvoiceDownload($id)
    {
        // Add validation and null checks
        $order = Order::with('division', 'district', 'state', 'user')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $orderItem = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();

        if ($orderItem->isEmpty()) {
            return redirect()->back()->with('error', 'No order items found.');
        }

        try {
            $pdf = PDF::loadView('frontend.user.order.order_invoice', compact('order', 'orderItem'));
            return $pdf->download('invoice-' . $order->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to generate invoice.');
        }
    }

    // Function for Return Order
    public function ReturnOrder(Request $request, $id)
    {
        Order::findOrFail($id)
            ->update([
                'return_date' => Carbon::now()->format('d-m-Y'),
                'return_reason' => $request->return_reason,
                'return_order' => 1,
            ]);

        $notification = [
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('my.order')->with($notification);
    }

    // Function for Return Order list
    public function ReturnOrderList()
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('return_reason', '!=', NULL)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.user.order.return_order_view', compact('orders'));
    }

    // Function for Cancel Order
    public function CancelOrder()
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('status', 'cancel')
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.user.order.cancel_order_view', compact('orders'));
    }

    // function for Order Tracking
    public function OrderTracking(Request $request)
    {
        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)
            ->first();

        if ($track) {

            return view('frontend.tracking.track_order', compact('track'));

        } else {
            $notification = [
                'message' => 'Invoice Code is Invalid',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }
}
