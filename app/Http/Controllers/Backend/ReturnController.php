<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function ReturnRequest()
    {
        $orders = Order::where('return_order', 1)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.return_order.return_request', compact('orders'));
    }

    public function ReturnRequestApproved($id)
    {
        Order::where('id', $id)
            ->update([
                'return_order' => 2
            ]);

        $notification = [
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function ReturnAllRequest(){
        $orders = Order::where('return_order', 2)
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.return_order.all_return_request', compact('orders'));
    }
}
