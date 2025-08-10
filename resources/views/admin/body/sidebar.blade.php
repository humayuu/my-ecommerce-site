@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();

    // Get admin permissions - moved to a more readable format
    $admin = auth()->guard('admin')->user();
    $permissions = [
        'brand' => $admin->brand == 1,
        'category' => $admin->category == 1,
        'product' => $admin->product == 1,
        'slider' => $admin->slider == 1,
        'coupons' => $admin->coupons == 1,
        'shipping' => $admin->shipping == 1,
        'blog' => $admin->blog == 1,
        'setting' => $admin->setting == 1,
        'returnOrder' => $admin->return_order == 1,
        'review' => $admin->review == 1,
        'orders' => $admin->orders == 1,
        'stock' => $admin->stock == 1,
        'reports' => $admin->reports == 1,
        'allUser' => $admin->all_user == 1,
        'adminUserRole' => $admin->admin_user_role == 1,
    ];
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="Admin Logo">
                        <h3><b>Ecommerce</b> Admin</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Dashboard -->
            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.login') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Brands -->
            @if ($permissions['brand'])
                <li class="treeview {{ $prefix == '/brand' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="tag"></i>
                        <span>Brands</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.brand' ? 'active' : '' }}">
                            <a href="{{ route('all.brand') }}">
                                <i class="ti-more"></i>All Brands
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Category -->
            @if ($permissions['category'])
                <li class="treeview {{ $prefix == '/category' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="grid"></i>
                        <span>Category</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all.category' ? 'active' : '' }}">
                            <a href="{{ route('all.category') }}">
                                <i class="ti-more"></i>All Categories
                            </a>
                        </li>
                        <li class="{{ $route == 'all.subcategory' ? 'active' : '' }}">
                            <a href="{{ route('all.subcategory') }}">
                                <i class="ti-more"></i>All SubCategories
                            </a>
                        </li>
                        <li class="{{ $route == 'all.subsubcategory' ? 'active' : '' }}">
                            <a href="{{ route('all.subsubcategory') }}">
                                <i class="ti-more"></i>All Sub-SubCategories
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Products -->
            @if ($permissions['product'])
                <li class="treeview {{ $prefix == 'product' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="package"></i>
                        <span>Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'add-product' ? 'active' : '' }}">
                            <a href="{{ route('add-product') }}">
                                <i class="ti-more"></i>Add Product
                            </a>
                        </li>
                        <li class="{{ $route == 'manage-product' ? 'active' : '' }}">
                            <a href="{{ route('manage-product') }}">
                                <i class="ti-more"></i>Manage Products
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Slider -->
            @if ($permissions['slider'])
                <li class="treeview {{ $prefix == 'slider' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="image"></i>
                        <span>Slider</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage-slider' ? 'active' : '' }}">
                            <a href="{{ route('manage-slider') }}">
                                <i class="ti-more"></i>Manage Slider
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Coupons -->
            @if ($permissions['coupons'])
                <li class="treeview {{ $prefix == 'coupons' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="percent"></i>
                        <span>Coupons</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage-coupons' ? 'active' : '' }}">
                            <a href="{{ route('manage-coupons') }}">
                                <i class="ti-more"></i>Manage Coupons
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Shipping Area -->
            @if ($permissions['shipping'])
                <li class="treeview {{ $prefix == 'shipping' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="truck"></i>
                        <span>Shipping Area</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage-division' ? 'active' : '' }}">
                            <a href="{{ route('manage-division') }}">
                                <i class="ti-more"></i>Ship Division
                            </a>
                        </li>
                        <li class="{{ $route == 'manage-district' ? 'active' : '' }}">
                            <a href="{{ route('manage-district') }}">
                                <i class="ti-more"></i>Ship District
                            </a>
                        </li>
                        <li class="{{ $route == 'manage-state' ? 'active' : '' }}">
                            <a href="{{ route('manage-state') }}">
                                <i class="ti-more"></i>Ship State
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Blog -->
            @if ($permissions['blog'])
                <li class="treeview {{ $prefix == 'blog' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="edit"></i>
                        <span>Manage Blog</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'blog-category' ? 'active' : '' }}">
                            <a href="{{ route('blog-category') }}">
                                <i class="ti-more"></i>Blog Category
                            </a>
                        </li>
                        <li class="{{ $route == 'add-blog-post' ? 'active' : '' }}">
                            <a href="{{ route('add-blog-post') }}">
                                <i class="ti-more"></i>Add Blog Post
                            </a>
                        </li>
                        <li class="{{ $route == 'list-blog-post' ? 'active' : '' }}">
                            <a href="{{ route('list-blog-post') }}">
                                <i class="ti-more"></i>List Blog Posts
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Orders -->
            @if ($permissions['orders'])
                <li class="treeview {{ $prefix == 'orders' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="shopping-cart"></i>
                        <span>Orders</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'pending-orders' ? 'active' : '' }}">
                            <a href="{{ route('pending-orders') }}">
                                <i class="ti-more"></i>Pending Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'confirm-orders' ? 'active' : '' }}">
                            <a href="{{ route('confirm-orders') }}">
                                <i class="ti-more"></i>Confirmed Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'processing-orders' ? 'active' : '' }}">
                            <a href="{{ route('processing-orders') }}">
                                <i class="ti-more"></i>Processing Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'picked-orders' ? 'active' : '' }}">
                            <a href="{{ route('picked-orders') }}">
                                <i class="ti-more"></i>Picked Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'shipped-orders' ? 'active' : '' }}">
                            <a href="{{ route('shipped-orders') }}">
                                <i class="ti-more"></i>Shipped Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'delivered-orders' ? 'active' : '' }}">
                            <a href="{{ route('delivered-orders') }}">
                                <i class="ti-more"></i>Delivered Orders
                            </a>
                        </li>
                        <li class="{{ $route == 'cancel-orders' ? 'active' : '' }}">
                            <a href="{{ route('cancel-orders') }}">
                                <i class="ti-more"></i>Cancelled Orders
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Stock Management -->
            @if ($permissions['stock'])
                <li class="treeview {{ $prefix == 'stock' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="archive"></i>
                        <span>Manage Stock</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'product-stock' ? 'active' : '' }}">
                            <a href="{{ route('product-stock') }}">
                                <i class="ti-more"></i>Product Stock
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Reports -->
            @if ($permissions['reports'])
                <li class="treeview {{ $prefix == 'reports' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="bar-chart-2"></i>
                        <span>Reports</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all-reports' ? 'active' : '' }}">
                            <a href="{{ route('all-reports') }}">
                                <i class="ti-more"></i>All Reports
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- All Users -->
            @if ($permissions['allUser'])
                <li class="treeview {{ $prefix == 'all-users' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="users"></i>
                        <span>All Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all-users' ? 'active' : '' }}">
                            <a href="{{ route('all-users') }}">
                                <i class="ti-more"></i>All Users
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Admin User Role -->
            @if ($permissions['adminUserRole'])
                <li class="treeview {{ $prefix == 'admin-user-role' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="user-check"></i>
                        <span>Admin User Role</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'all-admin-user' ? 'active' : '' }}">
                            <a href="{{ route('all-admin-user') }}">
                                <i class="ti-more"></i>All Admin Users
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Return Orders -->
            @if ($permissions['returnOrder'])
                <li class="treeview {{ $prefix == 'return' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="rotate-ccw"></i>
                        <span>Return Orders</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'return-request' ? 'active' : '' }}">
                            <a href="{{ route('return-request') }}">
                                <i class="ti-more"></i>Return Requests
                            </a>
                        </li>
                        <li class="{{ $route == 'all-request' ? 'active' : '' }}">
                            <a href="{{ route('all-request') }}">
                                <i class="ti-more"></i>All Requests
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Reviews -->
            @if ($permissions['review'])
                <li class="treeview {{ $prefix == 'review' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="star"></i>
                        <span>Manage Reviews</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'pending-reviews' ? 'active' : '' }}">
                            <a href="{{ route('pending-reviews') }}">
                                <i class="ti-more"></i>Pending Reviews
                            </a>
                        </li>
                        <li class="{{ $route == 'publish-reviews' ? 'active' : '' }}">
                            <a href="{{ route('publish-reviews') }}">
                                <i class="ti-more"></i>Published Reviews
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <!-- Settings -->
            @if ($permissions['setting'])
                <li class="treeview {{ $prefix == 'setting' ? 'active' : '' }}">
                    <a href="#">
                        <i data-feather="settings"></i>
                        <span>Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'site-setting' ? 'active' : '' }}">
                            <a href="{{ route('site-setting') }}">
                                <i class="ti-more"></i>Site Settings
                            </a>
                        </li>
                        <li class="{{ $route == 'seo-setting' ? 'active' : '' }}">
                            <a href="{{ route('seo-setting') }}">
                                <i class="ti-more"></i>SEO Settings
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- Settings -->
        <a href="{{ route('site-setting') }}" class="link" data-toggle="tooltip" title="Settings"
            aria-describedby="tooltip-settings">
            <i class="ti-settings"></i>
        </a>
        <!-- Email -->
        <a href="#" class="link" data-toggle="tooltip" title="Email" aria-describedby="tooltip-email">
            <i class="ti-email"></i>
        </a>
        <!-- Logout -->
        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="Logout"
            aria-describedby="tooltip-logout">
            <i class="ti-lock"></i>
        </a>
    </div>
</aside>
