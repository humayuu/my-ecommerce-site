@extends('admin.admin_master')

@section('main')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product Manage <span class="badge badge-pill badge-info">{{ count($products) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product En</th>
                                            <th>Product Price</th>
                                            <th>Quantity</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="text-center">
                                                <td><img src="{{ asset($product->product_thumbnail) }}"
                                                        style="width:60px; height: 70px;"></td>
                                                <td>{{ $product->product_name_en }}</td>
                                                <td>{{ $product->selling_price }} $</td>
                                                <td>{{ $product->product_qty }} Pic</td>
                                                <td>

                                                    @if ($product->discount_price == null)
                                                        <span class="badge badge-pill badge-danger">No Discount</span>
                                                    @else
                                                        @php
                                                            $amount =
                                                                $product->selling_price - $product->discount_price;
                                                            $discount = ($amount / $product->selling_price) * 100;
                                                        @endphp
                                                        <span
                                                            class="badge badge-pill badge-danger">{{ round($discount) }}%</span>
                                                    @endif


                                                </td>
                                                <td>
                                                    @if ($product->status == 1)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif

                                                </td>
                                                <td width="30%">
                                                    <a href="{{ route('product.detail', $product->id) }}"
                                                        title="Product Detail" class="btn btn-primary fa fa-eye"></a>
                                                    <a href="{{ route('product.edit', $product->id) }}" title="Edit Data"
                                                        class="btn btn-info fa fa-pencil"></a>
                                                    <a href="{{ route('product.delete', $product->id) }}" title="Delete Data" id="delete"
                                                        class="btn btn-danger fa fa-trash"></a>

                                                    @if ($product->status == 1)
                                                        <a href="{{ route('product.inactive', $product->id) }}"
                                                            title="Inactive Now"
                                                            class="btn btn-danger fa fa-arrow-down"></a>
                                                    @else
                                                        <a href="{{ route('product.active', $product->id) }}"
                                                            title="Active Now" class="btn btn-success fa fa-arrow-up"></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
    </div>
@endsection
