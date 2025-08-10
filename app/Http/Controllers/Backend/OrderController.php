<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display pending orders
     *
     * @return \Illuminate\View\View
     */
    public function PendingOrders()
    {
        $orders = Order::where('status', 'pending')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function PendingOrdersDetails($id)
    {

        $order = Order::with('division', 'district', 'state', 'user')
            ->where('id', $id)
            ->first();

        $orderItem = OrderItem::with('product')
            ->where('order_id', $id)
            ->orderBy('id', 'DESC')
            ->get();


        return view('backend.orders.pending_order_details', compact('order', 'orderItem'));
    }

    public function ConfirmOrder()
    {
        $orders = Order::where('status', 'confirm')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.confirm_orders', compact('orders'));
    }

    public function ProcessingOrder()
    {
        $orders = Order::where('status', 'processing')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.processing_orders', compact('orders'));
    }
    public function PickedOrder()
    {
        $orders = Order::where('status', 'picked')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.picked_orders', compact('orders'));
    }
    public function ShippedOrder()
    {
        $orders = Order::where('status', 'shipped')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.shipped_orders', compact('orders'));
    }

    public function DeliveredOrder()
    {

        $orders = Order::where('status', 'delivered')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function CancelOrder()
    {
        $orders = Order::where('status', 'cancel')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.orders.cancel_orders', compact('orders'));
    }

    public function PendingToConfirmOrder($id)
    {
        Order::findOrFail($id)
            ->update(['status' => 'confirm']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }


    public function ConfirmToProcessingOrder($id)
    {
        Order::findOrFail($id)
            ->update(['status' => 'processing']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }

    public function ProcessingToPickedOrder($id)
    {
        Order::findOrFail($id)
            ->update(['status' => 'picked']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }

    public function PickedToShippedOrder($id)
    {
        Order::findOrFail($id)
            ->update(['status' => 'shipped']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }

    public function ShippedToDeliveredOrder($id)
    {
        $products = Orderitem::where('order_id', $id)
            ->get();

        foreach ($products as $product) {
            Product::where('id', $product->product_id)
                ->update(['product_qty' => DB::raw('product_qty-' . $product->qty)]);
        }
        Order::findOrFail($id)
            ->update(['status' => 'delivered']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }

    public function DeliveredToCancelOrder($id)
    {
        Order::findOrFail($id)
            ->update(['status' => 'cancel']);


        $notification = [
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('pending-orders')->with($notification);
    }

    public function ConfirmInvoicePdf($id)
    {
        // Add validation and null checks
        $order = Order::with('division', 'district', 'state', 'user')
            ->where('id', $id)
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
            $pdf = PDF::loadView('backend.orders.order_invoice', compact('order', 'orderItem'));
            return $pdf->download('invoice-' . $order->id . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF generation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to generate invoice.');
        }
    }
}
