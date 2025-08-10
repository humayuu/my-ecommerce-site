@extends('admin.admin_master')

@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">


                {{-- _________________ Edit Sub-Sub Category Page________________ --}}

                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub-SubCategory</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('subsubcategory.update') }}">
                                    @csrf

                                    <input type="hidden" name="id" value="{{ $subSubCategories->id }}">

                                    <div class="form-group">
                                        <h5>Category Select<span class="text-danger">*</span></h5>
                                        <select name="category_id" class="form-control">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $subSubCategories->category_id ? 'selected' : null }}>{{ $category->category_name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>SubCategory Select<span class="text-danger">*</span></h5>
                                        <select name="subcategory_id" class="form-control">
                                            @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}" {{ $subCategory->id == $subSubCategories->subcategory_id ? 'selected' : null }}>{{ $subCategory->subcategory_name_en }}
                                            </option>
                                        @endforeach

                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>Sub-SubCategory Name English<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_en" class="form-control" value="{{ $subSubCategories->subsubcategory_name_en }}">
                                            @error('subsubcategory_name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Sub-SubCategory Name Urdu<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="subsubcategory_name_urdu" class="form-control" value="{{ $subSubCategories->subsubcategory_name_urdu }}">
                                            @error('subsubcategory_name_urdu')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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
