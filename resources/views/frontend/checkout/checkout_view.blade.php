@extends('frontend.main_master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    @section('title')
        My Checkout
    @endsection


    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>My Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->


    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel-group checkout-steps" id="accordion">
                            <!-- checkout-step-01  -->
                            <div class="panel panel-default checkout-step-01">



                                <div id="collapseOne" class="panel-collapse collapse in">

                                    <!-- panel-body  -->
                                    <div class="panel-body">
                                        <div class="row">

                                            <!-- guest-login -->
                                       <div class="col-md-6 col-sm-6 already-registered-login">
                                                <h4 class="checkout-subtitle"><strong>Shipping Address</strong></h4>
                                                <form  class="register-form" method="POST" action="{{ route('checkout.store') }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Shipping Name
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="shipping_name" required placeholder="Full Name" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Email
                                                            <span>*</span></label>
                                                        <input type="email"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="shipping_email" required placeholder="Email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Phone
                                                            <span>*</span></label>
                                                        <input type="number"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="shipping_phone" required placeholder="Phone" value="{{ Auth::user()->phone }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Post Code
                                                            <span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="exampleInputEmail1" name="post_code" required placeholder="Post Code" >
                                                    </div>
                                            </div>
                                            <!-- guest-login -->

                                            <!-- already-registered-login -->
                                            <div class="col-md-6 col-sm-6 already-registered-login">
                                                <div class="form-group">
                                                    <h5><strong>Division Select</strong><span class="text-danger">*</span></h5>
                                                    <select name="division_id" class="form-control" required>
                                                        <option value="" selected disabled>Select Division</option>
                                                        @foreach ($divisions as $division)
                                                            <option value="{{ $division->id }}">{{ $division->division_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <h5><strong>District Select</strong><span class="text-danger">*</span></h5>
                                                    <select name="district_id" class="form-control" required>
                                                        <option value="" selected disabled>Select District</option>

                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <h5><strong>State Select</strong><span class="text-danger">*</span></h5>
                                                    <select name="state_id" class="form-control" required>
                                                        <option value="" selected disabled>Select State</option>

                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                 <div class="form-group">
                                                        <label class="info-title" for="exampleInputEmail1">Notes
                                                            <span>*</span></label>
                                                            <textarea class="form-control" cols="30" rows="5"  name="notes"></textarea>
                                                    </div>


                                            </div>
                                            <!-- already-registered-login -->

                                        </div>
                                    </div>
                                    <!-- panel-body  -->

                                </div><!-- row -->
                            </div>
                            <!-- checkout-step-01  -->

                            <!-- checkout-step-06  -->

                        </div><!-- /.checkout-steps -->
                    </div>

                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach ($carts as $cart)

                                            <li><strong>Image: </strong>
                                                <img src="{{ asset($cart->options->image) }}" style="height:50px; width:50px;" >
                                            </li>

                                            <li>
                                                <strong>Qty: </strong>
                                               ( {{ $cart->qty }} )

                                                <strong>Qty: </strong>
                                                {{ $cart->options->color }}

                                                <strong>Qty: </strong>
                                                {{  $cart->options->size }}
                                            </li> <hr>

                                            @endforeach

                                            @if(Session::has('coupon'))
                                            <li><strong>SubTotal: </strong> ${{ $cartTotal }}</li> <hr>

                                            <li><strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }}% )
                                            </li>
                                            <hr>

                                            <li><strong>Coupon Discount : </strong> ${{ session()->get('coupon')['discount_amount'] }}
                                            </li>
                                            <hr>

                                            <li><strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount'] }}
                                            </li>
                                            <hr>

                                            @else
                                             <li><strong>SubTotal: </strong> ${{ $cartTotal }}</li> <hr>

                                            <li><strong>Grand Total : </strong> ${{ $cartTotal }}</li> <hr>
                                            @endif


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>

                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Stripe</label>
                                            <input type="radio" name="payment_method" value="stripe">
                                            <img src="{{ asset('frontend/assets/images/payments/4.png') }}">
                                        </div>
                                        <div class="col-md-4">
                                               <label for="">Card</label>
                                            <input type="radio" name="payment_method" value="Card">
                                            <img src="{{ asset('frontend/assets/images/payments/3.png') }}">
                                        </div>
                                        <div class="col-md-4">
                                               <label for="">Cash</label>
                                            <input type="radio" name="payment_method" value="Cash">
                                            <img src="{{ asset('frontend/assets/images/payments/9.png') }}">
                                        </div>
                                    </div> <hr>
                                     <button type="submit"
                                     class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                 </form>

                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item m-t-10">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div><!--/.item-->
                    </div><!-- /.owl-carousel #logo-slider -->
                </div><!-- /.logo-slider-inner -->

            </div><!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->



<script type="text/javascript">
        $(document).ready(function() {
          $('select[name="division_id"]').on('change', function(){
              let division_id = $(this).val();
              if(division_id) {
                  $.ajax({
                      url: "{{  url('/district-get/ajax') }}/"+division_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                        $('select[name="state_id"]').empty();
                         let d = $('select[name="district_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });

          $('select[name="district_id"]').on('change', function(){
              let district_id = $(this).val();
              if(district_id) {
                  $.ajax({
                      url: "{{  url('/state-get/ajax') }}/"+district_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         let d =$('select[name="state_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });
      });
      </script>



@endsection
