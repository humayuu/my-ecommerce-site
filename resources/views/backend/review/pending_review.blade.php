@extends('admin.admin_master')

@section('main')
    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">



                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pending Review List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product Name </th>
                                            <th>Summary </th>
                                            <th>Comment </th>
                                            <th>User Name </th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td> {{ $review->product->product_name_en }} </td>
                                                <td> {{ $review->summary }} </td>
                                                <td> {{ $review->comment }} </td>
                                                <td> {{ $review->user->name }} </td>
                                                <td>
                                                    @if ($review->status == 0)
                                                        <span class="badge badge-pill badge-primary">Pending </span>
                                                    @elseif($review->return_order == 1)
                                                        <span class="badge badge-pill badge-success">Publish </span>
                                                    @endif

                                                </td>

                                                <td width="25%">
                                                    <a id="review" href="{{ route('review.approve', $review->id) }}"
                                                        class="btn btn-danger">Approve </a>
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
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
