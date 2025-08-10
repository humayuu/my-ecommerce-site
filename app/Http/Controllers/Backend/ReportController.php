<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Order;

class ReportController extends Controller
{
    public function ReportView()
    {
        return view('backend.report.report_view');
    }

    public function ReportSearchByDate(Request $request)
    {
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $orders = Order::where('order_date', $formatDate)->get();
        return view('backend.report.report_show', compact('orders'));
    }

    public function ReportSearchByMonth(Request $request)
    {

        $orders = Order::where('order_month', $request->month)
            ->where('order_year', $request->year_name)
            ->latest()
            ->get();
        return view('backend.report.report_show', compact('orders'));
    }

    public function ReportSearchByYear(Request $request)
    {
        $orders = Order::where('order_year', $request->only_year)
            ->latest()
            ->get();
        return view('backend.report.report_show', compact('orders'));
    }
}
