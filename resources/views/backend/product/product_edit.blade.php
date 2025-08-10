@extends('admin.admin_master')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <div class="container-full">
        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Product</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">


                        <div class="col">
                            <form method="POST" action="{{ route('product.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $products->id }}">

                                <div class="row">
                                    <div class="col-12">
                                        {{-- First Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select<span class="text-danger">*</span></h5>
                                                    <select name="brand_id" class="form-control" required>
                                                        <option value="" selected disabled>Select Brand</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}"
                                                                {{ $brand->id == $products->brand_id ? 'selected' : null }}>
                                                                {{ $brand->brand_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select<span class="text-danger">*</span></h5>
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $category->id == $products->category_id ? 'selected' : null }}>
                                                                {{ $category->category_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubCategory Select<span class="text-danger">*</span></h5>
                                                    <select name="subcategory_id" class="form-control" required>
                                                        <option value="" selected disabled>Select SubCategory</option>
                                                        @foreach ($subCategories as $subCategory)
                                                            <option value="{{ $subCategory->id }}"
                                                                {{ $subCategory->id == $products->subcategory_id ? 'selected' : null }}>
                                                                {{ $subCategory->subcategory_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- First Row End Here --}}


                                        {{-- Second Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>SubSubCategory Select<span class="text-danger">*</span></h5>
                                                    <select name="subsubcategory_id" class="form-control" required>
                                                        <option value="" selected disabled>Select SubSubCategory
                                                        </option>
                                                        @foreach ($subSubcategories as $subSubcategory)
                                                            <option value="{{ $subSubcategory->id }}"
                                                                {{ $subSubcategory->id == $products->subsubcategory_id ? 'selected' : null }}>
                                                                {{ $subSubcategory->subsubcategory_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('subsubcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_en" class="form-control"
                                                            required value="{{ $products->product_name_en }}">
                                                        @error('product_name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_name_urdu" class="form-control"
                                                            required value="{{ $products->product_name_urdu }}">
                                                        @error('product_name_urdu')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Second Row Ends Here --}}

                                        {{-- Third Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Code<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_code" class="form-control"
                                                            required value="{{ $products->product_code }}">
                                                        @error('product_code')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_qty" class="form-control"
                                                            required value="{{ $products->product_qty }}">
                                                        @error('product_qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tags En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_en" class="form-control"
                                                            value="{{ $products->product_tags_en }}" data-role="tagsinput"
                                                            required>
                                                        @error('product_tags_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Third Row Ends Here --}}


                                        {{-- Fourth Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Tags Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_tags_urdu"
                                                            class="form-control"
                                                            value="{{ $products->product_tags_urdu }}"
                                                            data-role="tagsinput" required>
                                                        @error('product_tags_urdu')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_en" class="form-control"
                                                            value="{{ $products->product_size_en }}"
                                                            data-role="tagsinput">
                                                        @error('product_size_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Size Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_size_urdu"
                                                            class="form-control"
                                                            value="{{ $products->product_size_urdu }}"
                                                            data-role="tagsinput">
                                                        @error('product_size_urdu')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Fourth Row Ends Here --}}

                                        {{-- Fifth Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Color En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_en"
                                                            class="form-control"
                                                            value="{{ $products->product_color_en }}"
                                                            data-role="tagsinput">
                                                        @error('product_color_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Size Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_color_urdu"
                                                            class="form-control"
                                                            value="{{ $products->product_color_urdu }}"
                                                            data-role="tagsinput">
                                                        @error('product_color_urdu')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Fifth Row Ends Here --}}

                                        {{-- Sixth Row Start Here --}}
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Selling Price<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="selling_price" class="form-control"
                                                            value="{{ $products->selling_price }}">
                                                        @error('selling_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="discount_price" class="form-control"
                                                            value="{{ $products->discount_price }}">
                                                        @error('discount_price')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- Sixth Row Ends Here --}}



                                        {{-- Seven Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_description_en" id="short_description_en" class="form-control" required
                                                            placeholder="Textarea text">{!! $products->short_description_en !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_description_urdu" id="short_description_urdu" class="form-control" required
                                                            placeholder="Textarea text">{!! $products->short_description_urdu !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Seven Row Ends Here --}}

                                        {{-- Eight Row Start Here --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" rows="10" cols="80" name="long_description_en" class="form-control" required
                                                            placeholder="Textarea text">{!! $products->long_description_en !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description Urdu<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" rows="10" cols="80" name="long_description_urdu" class="form-control" required
                                                            placeholder="Textarea text">{!! $products->long_description_urdu !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Eight Row Ends Here --}}

                                        <hr>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_2" name="hot_deals"
                                                        value="1" {{ $products->hot_deals == 1 ? 'checked' : null }}>
                                                    <label for="checkbox_2">Hot Deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_3" name="featured"
                                                        value="1" {{ $products->featured == 1 ? 'checked' : null }}>
                                                    <label for="checkbox_3">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Checkbox Group <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_4" name="special_offer"
                                                        value="1"
                                                        {{ $products->special_offer == 1 ? 'checked' : null }}>
                                                    <label for="checkbox_4">Special Offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="checkbox_5" name="special_deals"
                                                        value="1"
                                                        {{ $products->special_deals == 1 ? 'checked' : null }}>
                                                    <label for="checkbox_5">Special Deals</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                    </div>
                </div>


                </form>

            </div>
            <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

    </section>
    <!-- /.content -->

{{-- Start Multiple Image Edit --}}

    <section class="content" style="margin-left: 280px">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Multiple Image<strong>Update</strong></h4>
                    </div>

                    <form method="POST" action="{{ route('update.product.image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm  mt-5">
                            @foreach ($multiImages as $multiImage)
                                <div class="col-md-3">

                                    <div class="card">
                                        <img src="{{ asset($multiImage->photo_name) }}" class="card-img-top"
                                            style="height: 130px; width: 190px;">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('product.multiimage.delete', $multiImage->id) }}" class="btn btn-sm btn-danger" id="delete"
                                                    title="Delete Data"><i class="fa fa-trash"></i> </a>
                                            </h5>
                                            <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span
                                                        class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[ {{ $multiImage->id }} ]">
                                            </div>
                                            </p>

                                        </div>
                                    </div>

                                </div><!--  end col md 3		 -->
                            @endforeach

                        </div>

                        <div class="form-layout-footer">
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5 ml-5" value="Update Image">
                            </div>
                        </div>
                        <br><br>

                    </form>
                </div>
            </div>
        </div>

    </section>

    {{-- End Multiple Image Edit --}}

    {{-- Start Thumbnail Image Edit --}}

    <section class="content" style="margin-left: 280px">
        <div class="row">
            <div class="col-md-12   ">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Product Thumbnail Image <strong>Update</strong></h4>
                    </div>

                    <form method="POST" action="{{ route('update.product.thumbnail') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $products->id }}">
                        <input type="hidden" name="oldImage" value="{{ $products->product_thumbnail }}">
                        <div class="row row-sm  mt-5">
                                <div class="col-md-3">

                                    <div class="card">
                                        <img src="{{ asset($products->product_thumbnail) }}" class="card-img-top"
                                            style="height: 130px; width: 190px;">
                                        <div class="card-body">
                                            <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span
                                                        class="tx-danger">*</span></label>
                                                        <input type="file" name="product_thumbnail" class="form-control" onchange="mainThambnailUrl(this)">
                                                        <img src="" id="mainThambnail">
                                            </div>
                                            </p>

                                        </div>
                                    </div>

                                </div><!--  end col md 3		 -->

                        </div>

                        <div class="form-layout-footer">
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5 ml-5" value="Update Image">
                            </div>
                        </div>
                        <br><br>

                    </form>
                </div>
            </div>
        </div>

    </section>

    {{-- End Thumbnail Image Edit --}}

    </div>




    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                let category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subsubcategory_id"]').html('');
                            let d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            $('select[name="subcategory_id"]').on('change', function() {
                let subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{ url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            let d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subsubcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subsubcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
    <script type="text/javascript">
        function mainThambnailUrl(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThambnail').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>



    <script>
        $(document).ready(function() {
            $('#multipleimg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(80)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection
