@extends('admin.admin_master')

@section('main')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Post <span
                                    class="badge badge-pill badge-info">{{ count($blogPost) }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Post Category</th>
                                            <th>Post Image</th>
                                            <th>Post Title En</th>
                                            <th>Post Title Urdu</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogPost as $post)
                                            <tr>
                                                <td>{{ $post->category->blog_category_name_en }}</td>
                                                <td><img width="100" src="{{ asset($post->post_image) }}" alt="">
                                                </td>
                                                <td>{{ $post->post_title_en }}</td>
                                                <td>{{ $post->post_title_urdu }}</td>
                                                <td>
                                                    <a href="" title="Edit Data"
                                                        class="btn btn-info fa fa-pencil"></a>
                                                    <a href="" title="Delete Data" id="delete"
                                                        class="btn btn-danger fa fa-trash"></a>
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
