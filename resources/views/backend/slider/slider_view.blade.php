@extends('admin.admin_master')

@section('main')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Slider List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th >Slider Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th width="30%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                            <tr>
                                                <td><img style="width: 90px; height: 60px; margin-left: 10%;" src="{{ asset($slider->slider_img) }}"
                                                    alt="Brand Image">
                                            </td>
                                                <td>
                                                    @if ($slider->title == null)
                                                    <span class="badge badge-pill badge-danger">No Title</span>
                                                @else
                                                {{ $slider->title }}
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($slider->description == null)
                                                    <span class="badge badge-pill badge-danger">No Description</span>
                                                @else
                                                {{ $slider->description }}
                                                @endif
                                                </td>
                                                <td>
                                                    @if ($slider->status == 1)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif

                                                </td>

                                                <td>
                                                    <a href="{{ route('slider.edit', $slider->id) }}" title="Edit Data" class="btn btn-info btn-sm fa fa-pencil"></a>
                                                    <a href="{{ route('slider.delete', $slider->id) }}" title="Delete Data" id="delete" class="btn btn-danger btn-sm fa fa-trash"></a>
                                                    @if ($slider->status == 1)
                                                    <a href="{{ route('slider.inactive', $slider->id) }}"
                                                        title="Inactive Now"
                                                        class="btn btn-danger btn-sm fa fa-arrow-down"></a>
                                                @else
                                                    <a href="{{ route('slider.active', $slider->id) }}"
                                                        title="Active Now" class="btn btn-success btn-sm fa fa-arrow-up"></a>
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


                {{-- _________________ Add Brand Page________________ --}}

                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Title<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="description" class="form-control"></textarea>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Slider Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="slider_img" class="form-control">
                                            @error('slider_img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
    </div>
@endsection
