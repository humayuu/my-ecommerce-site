<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->

    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-user"></i>
                                @if (session()->get('language') == 'urdu')
                                    میرا
                                    اکاؤنٹ
                                @else
                                    My Account
                                @endif
                            </a>
                        </li>
                        <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>
                                @if (session()->get('language') == 'urdu')
                                    خواہش
                                    کی فہرست
                                @else
                                    Wishlist
                                @endif
                            </a>
                        </li>
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>
                                @if (session()->get('language') == 'urdu')
                                    میری ٹوکری
                                @else
                                    My Cart
                                @endif
                            </a>
                        </li>
                        <li><a href="{{ route('checkout') }}"><i class="icon fa fa-check"></i>
                                @if (session()->get('language') == 'urdu')
                                    چیک
                                    آؤٹ
                                @else
                                    Checkout
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#orderTracking">
                                <i class="icon fa fa-check"></i>
                                @if (session()->get('language') == 'urdu')
                                    آرڈر ٹریکنگ
                                @else
                                    Order Tracking
                                @endif
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('user.profile') }}">
                                    <i class="icon fa fa-user"></i>
                                    @if (session()->get('language') == 'urdu')
                                        میرا اکاؤنٹ
                                    @else
                                        My Account
                                    @endif {{ __('User Profile') }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}">
                                    <i class="icon fa fa-lock"></i>
                                    @if (session()->get('language') == 'urdu')
                                        لاگ ان/رجسٹر
                                    @else
                                        Login/Register
                                    @endif
                                </a>
                            </li>
                        @endauth

                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle"
                                data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle"
                                data-hover="dropdown" data-toggle="dropdown"><span class="value">
                                    @if (session()->get('language') == 'urdu')
                                        زبان
                                    @else
                                        Language
                                    @endif
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (session()->get('language') == 'urdu')
                                    <li><a href="{{ route('english.language') }}">English</a></li>
                                @else
                                    <li><a href="{{ route('urdu.language') }}">اردو</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    @php
                        $setting = App\Models\SiteSetting::find(1);
                    @endphp
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{ asset($setting->logo) }}"
                                alt="logo"> </a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="post" action="{{ route('product-search') }}">
                            @csrf
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"
                                            href="category.html">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()"
                                    id="search" name="search" placeholder="Search here..." />
                                <button type="submit" class="search-button"></button>
                            </div>
                        </form> 
                        <div id="searchProducts"></div>


                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"></span></div>
                                <div class="total-price-basket"> <span class="lbl">cart -</span>
                                    <span class="total-price"> <span class="sign">$</span>
                                        <span class="value" id="cartSubTotal"></span> </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>

                                {{-- Mini Cart Start --}}

                                <div id="miniCart">

                                </div>


                                {{-- Mini Cart End --}}

                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total :</span><span
                                            class='price' id="cartSubTotal"></span> </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}"
                                        data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                        Home</a> </li>


                                {{-- Get Data From Category Table --}}
                                @php
                                    $categories = App\Models\Category::orderBy('category_name_en', 'ASC')->get();
                                @endphp


                                @foreach ($categories as $category)
                                    <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown"
                                            class="dropdown-toggle" data-toggle="dropdown">
                                            @if (session()->get('language') == 'urdu')
                                                {{ $category->category_name_urdu }}
                                            @else
                                                {{ $category->category_name_en }}
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        {{-- Get Data From SubCategory Table --}}
                                                        @php
                                                            $subCategories = App\Models\SubCategory::where(
                                                                'category_id',
                                                                $category->id,
                                                            )
                                                                ->orderBy('subcategory_name_en', 'ASC')
                                                                ->get();
                                                        @endphp

                                                        @foreach ($subCategories as $subCategory)
                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">

                                                                <a
                                                                    href="{{ url('subcategory/product/' . $subCategory->id . '/' . $subCategory->subcategory_slug_en) }}">
                                                                    <h2 class="title">
                                                                        @if (session()->get('language') == 'urdu')
                                                                            {{ $subCategory->subcategory_name_urdu }}
                                                                        @else
                                                                            {{ $subCategory->subcategory_name_en }}
                                                                        @endif
                                                                    </h2>
                                                                </a>

                                                                {{-- Get Data From subSubCategory Table --}}
                                                                @php
                                                                    $subSubCategories = App\Models\SubSubCategory::where(
                                                                        'subcategory_id',
                                                                        $subCategory->id,
                                                                    )
                                                                        ->orderBy('subsubcategory_name_en', 'ASC')
                                                                        ->get();
                                                                @endphp
                                                                @foreach ($subSubCategories as $subSubCategory)
                                                                    <ul class="links">
                                                                        <li><a
                                                                                href="{{ url('subsubcategory/product/' . $subSubCategory->id . '/' . $subSubCategory->subsubcategory_slug_en) }}">
                                                                                @if (session()->get('language') == 'urdu')
                                                                                    {{ $subSubCategory->subsubcategory_name_urdu }}
                                                                                @else
                                                                                    {{ $subSubCategory->subsubcategory_name_en }}
                                                                                @endif
                                                                            </a></li>
                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                        <!-- /.col -->

                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                            <img class="img-responsive"
                                                                src="{{ asset('frontend/assets/images/banners/') }}top-menu-banner.jpg"
                                                                alt="">
                                                        </div>
                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach
                                   <li> <a href="{{ route('shop-page') }}">Shop</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays
                                        offer</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a
                                        href="{{ route('home-blog') }}">Blog</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->
    <!-- Order Modal -->
    <div class="modal fade" id="orderTracking" tabindex="-1" aria-labelledby="orderTrackingLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderTrackingLabel">
                        @if (session()->get('language') == 'urdu')
                            اپنے آرڈر کو ٹریک کریں۔
                        @else
                            Track Your Order
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add your order tracking form here -->
                    <form method="post" action="{{ route('order-tacking') }}">
                        @csrf
                        <div class="modal-body">
                            <label>Invoice Code</label>
                            <input type="text" name="code" required="" class="form-control"
                                placeholder="Your Order Invoice Number">
                        </div>

                        <button class="btn btn-primary" type="submit" style="margin-left: 17px;"> Track Now
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        .search-area {
            position: relative;
        }

        #searchProducts {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #ffffff;
            z-index: 999;
            border-radius: 8px;
            margin-top: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 1px solid #e5e5e5;
            max-height: 300px;
            overflow-y: auto;
        }

        #searchProducts ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #searchProducts li {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        #searchProducts li:last-child {
            border-bottom: none;
        }

        #searchProducts li:hover {
            background-color: #f8f9fa;
        }

        #searchProducts li img {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            object-fit: cover;
            margin-right: 12px;
            border: 1px solid #e5e5e5;
        }

        #searchProducts li span,
        #searchProducts li {
            font-size: 14px;
            color: #333;
            font-weight: 400;
        }

        #searchProducts li:hover {
            color: #007bff;
        }

        /* Custom scrollbar */
        #searchProducts::-webkit-scrollbar {
            width: 4px;
        }

        #searchProducts::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #searchProducts::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 2px;
        }
    </style>


    <script>
        function search_result_hide() {
            $("#searchProducts").slideUp();
        }

        function search_result_show() {
            $("#searchProducts").slideDown();
        }
    </script>
</header>
