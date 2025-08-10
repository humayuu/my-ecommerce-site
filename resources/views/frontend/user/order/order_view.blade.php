@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    @include('frontend.common.user_sidebar');
                </div>

                <div class="col-md-2">
                </div>

                <div class="col-md-8">

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for=""> Date</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Total</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Payment</label>
                                    </td>


                                    <td class="col-md-2">
                                        <label for=""> Invoice</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> Order</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> Action </label>
                                    </td>

                                </tr>


                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="col-md-1">
                                            <label for=""> {{ $order->order_date }}</label>
                                        </td>

                                        <td class="col-md-3">
                                            <label for=""> ${{ $order->amount }}</label>
                                        </td>


                                        <td class="col-md-3">
                                            <label for=""> {{ $order->payment_method }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $order->invoice_no }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for="">
                                                @if ($order->status == 'pending')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #007bff; color: white;">Pending</span>
                                                @elseif ($order->status == 'confirm')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #28a745; color: white;">Confirm</span>
                                                @elseif ($order->status == 'processing')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #ffc107; color: black;">Processing</span>
                                                @elseif ($order->status == 'picked')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #6c757d; color: white;">Picked</span>
                                                @elseif ($order->status == 'shipped')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #17a2b8; color: white;">Shipped</span>
                                                @elseif ($order->status == 'delivered')
                                                    <span class="badge badge-pill"
                                                        style="background-color: #218838; color: white;">Delivered</span>
                                                    @if ($order->return_order == 1)
                                                        <span class="badge badge-pill badge-warning"
                                                            style="background: #c21717;">Return Request </span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-pill"
                                                        style="background-color: #dc3545; color: white;">Cancel</span>
                                                @endif


                                            </label>
                                        </td>

                                        <td class="col-md-1">
                                            <a href="{{ route('order-detail', $order->id) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>

                                            <a target="_blank" style="margin-top:10px;"
                                                href="{{ route('invoice-download', $order->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-download"
                                                    style="color: white;"></i> Invoice </a>

                                        </td>

                                    </tr>
                                @endforeach





                            </tbody>

                        </table>

                    </div>

                </div> <!-- / end col md 8 -->
            </div>
        </div>
    </div>
@endsection
