<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Frontend\HomeBlogController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\ReviewController;
use App\Models\SiteSetting;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('admin:admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('admin/login', 'LoginForm');
        Route::post('admin/login', 'store')->name('admin.login');
    });
});


Route::middleware(['auth:admin'])->group(function () {

    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('admin/dashboard', function () {
            return view('admin.index');
        })->name('dashboard')->middleware('auth:admin');
    });



    // Admin All Routes Starts Here
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::get('admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');


    Route::post('admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('admin/update/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.update.change.password');


    // Admin Brand All Routes Start Here
    Route::prefix('brand')->group(function () {

        Route::controller(BrandController::class)->group(function () {
            Route::get('/view', 'BrandView')->name('all.brand');
            Route::get('/edit/{id}', 'BrandEdit')->name('brand.edit');
            Route::get('/delete/{id}', 'BrandDelete')->name('brand.delete');


            Route::post('/store', 'BrandStore')->name('brand.store');
            Route::post('/update', 'BrandUpdate')->name('brand.update');
        });
    });

    // Admin Category All Routes Start Here
    Route::prefix('category')->group(function () {

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/view', 'CategoryView')->name('all.category');
            Route::get('/edit/{id}', 'CategoryEdit')->name('category.edit');
            Route::get('/delete/{id}', 'CategoryDelete')->name('delete.edit');


            Route::post('/store', 'CategoryStore')->name('category.store');
            Route::post('/update', 'CategoryUpdate')->name('category.update');
        });
    });

    // Admin Sub Category All Routes Start Here
    Route::prefix('category')->group(function () {

        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/sub/view', 'SubCategoryView')->name('all.subcategory');
            Route::get('/sub/edit/{id}', 'SubCategoryEdit')->name('subcategory.edit');
            Route::get('/sub/delete/{id}', 'SubCategoryDelete')->name('subcategory.delete');


            Route::post('/sub/store', 'SubCategoryStore')->name('subcategory.store');
            Route::post('/sub/update', 'SubCategoryUpdate')->name('subcategory.update');

            // Admin Sub->sub Category All Routes End Here
            Route::get('/sub/sub/view', 'SubSubCategoryView')->name('all.subsubcategory');
            Route::get('subcategory/ajax/{category_id}', 'GetSubCategory');
            Route::get('sub-subcategory/ajax/{subcategory_id}', 'GetSubSubCategory');
            Route::get('/sub/sub/edit/{id}', 'SubSubCategoryEdit')->name('subsubcategory.edit');
            Route::get('/sub/sub/delete/{id}', 'SubSubCategoryDelete')->name('subsubcategory.delete');


            Route::post('/sub/sub/store', 'SubSubCategoryStore')->name('subsubcategory.store');
            Route::post('/sub/sub/update', 'SubSubCategoryUpdate')->name('subsubcategory.update');
        });
    });

    // Admin Mange Reviews All Routes Here
    Route::prefix('review')->group(function () {

        Route::controller(ReviewController::class)->group(function () {
            Route::get('/pending', 'PendingReview')->name('pending-reviews');
            Route::get('/approve/{id}', 'ReviewApprove')->name('review.approve');
            Route::get('/publish', 'PublishReview')->name('publish-reviews');


            Route::get('/delete/{id}', 'ReviewDelete')->name('delete.review');
        });
    });

    // Admin Products All Routes Start Here
    Route::prefix('product')->group(function () {

        Route::controller(ProductController::class)->group(function () {
            Route::get('/add', 'ProductAdd')->name('add-product');
            Route::get('/manage', 'ProductManage')->name('manage-product');
            Route::get('/edit/{id}', 'ProductEdit')->name('product.edit');
            Route::get('/multiple/image/delete/{id}', 'ProductMultipleDelete')->name('product.multiimage.delete');
            Route::get('/detail/{id}', 'ProductDetail')->name('product.detail');
            Route::get('/inactive/{id}', 'ProductInactive')->name('product.inactive');
            Route::get('/active/{id}', 'ProductActive')->name('product.active');
            Route::get('/delete/{id}', 'ProductDelete')->name('product.delete');



            Route::post('/store', 'ProductStore')->name('product.store');
            Route::post('/update', 'ProductUpdate')->name('product.update');
            Route::post('/image/update', 'MultiImageUpdate')->name('update.product.image');
            Route::post('/thumbnail/update', 'ThumbnailImageUpdate')->name('update.product.thumbnail');
        });
    });

    // Admin Slider All Routes Start Here
    Route::prefix('slider')->group(function () {

        Route::controller(SliderController::class)->group(function () {
            Route::get('/view', 'ManageSlider')->name('manage-slider');
            Route::get('/edit/{id}', 'ManageEdit')->name('slider.edit');
            Route::get('/delete/{id}', 'SliderDelete')->name('slider.delete');
            Route::get('/inactive/{id}', 'SliderInactive')->name('slider.inactive');
            Route::get('/active/{id}', 'SliderActive')->name('slider.active');


            Route::post('/store', 'SliderStore')->name('slider.store');
            Route::post('/update', 'SliderUpdate')->name('slider.update');
        });
    });
}); // Ends Middleware



// Admin Coupons All Routes Start Here
Route::prefix('coupons')->group(function () {

    Route::controller(CouponController::class)->group(function () {
        Route::get('/view', 'CouponView')->name('manage-coupons');
        Route::get('/edit/{id}', 'CouponEdit')->name('coupon.edit');
        Route::get('/delete/{id}', 'CouponDelete')->name('coupon.delete');


        Route::post('/update/{id}', 'CouponUpdate')->name('coupon.update');
        Route::post('/store', 'CouponStore')->name('coupon.store');
    });
});

// Admin Reports All Routes Start Here
Route::prefix('reports')->group(function () {

    Route::controller(ReportController::class)->group(function () {
        Route::get('/view', 'ReportView')->name('all-reports');


        Route::post('/search/by/date', 'ReportSearchByDate')->name('search-by-date');
        Route::post('/search/by/month', 'ReportSearchByMonth')->name('search-by-month');
        Route::post('/search/by/year', 'ReportSearchByYear')->name('search-by-year');
    });
});

// Admin Get All Users Routes Start Here
Route::prefix('all-users')->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/view', 'AllUsers')->name('all-users');
    });
});

// Admin User Roles All Routes Start here
Route::prefix('admin-user-role')->group(function () {
    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/all', 'AllAdminRole')->name('all-admin-user');
        Route::get('/add', 'AddAdminRole')->name('add-admin');
        Route::get('/edit/{id}', 'EditAdminRole')->name('edit-admin-user');
        Route::get('/delete/{id}', 'DeleteAdminRole')->name('delete-admin-user');

        Route::post('/store', 'StoreAdminRole')->name('admin-user-store');
        Route::post('/update', 'UpdateAdminRole')->name('update-admin-role');
    });
});


// Admin All Blog Routes Start Here
Route::prefix('blog')->group(function () {

    Route::controller(BlogController::class)->group(function () {
        Route::get('/category', 'BlogCategory')->name('blog-category');
        Route::get('/category/edit/{id}', 'BlogCategoryEdit')->name('blog-category-edit');
        Route::get('/category/delete/{id}', 'BlogCategoryDelete')->name('blog-category-delete');



        Route::post('/category/store', 'BlogCategoryStore')->name('blog-category-store');
        Route::post('/category/update/{id}', 'BlogCategoryUpdate')->name('blog-category-update');

        Route::get('/add/post', 'AddBlogPost')->name('add-blog-post');
        Route::get('/list/post', 'ListBlogPost')->name('list-blog-post');
        Route::get('/post/detail/{id}', 'BlogPostDetail')->name('blog-detail');



        Route::post('/post/store', 'BlogPostStore')->name('blog-post-store');
    });
});

// Admin All Stock Management Routes Start Here
Route::prefix('stock')->group(function () {

    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'ProductStock')->name('product-stock');
    });
});

// Frontend Blog Show Routes
Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home-blog');
Route::get('/blog/post/category/{id}', [HomeBlogController::class, 'BlogPostCategory'])->name('blog-category-post');


// Site Setting Routes
Route::prefix('setting')->group(function () {
    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/site', 'SiteSetting')->name('site-setting');
        Route::get('/site/seo', 'SeoSetting')->name('seo-setting');

        Route::post('/site/update/{id}', 'SiteSettingUpdate')->name('update-site-setting');
        Route::post('/site/seo/update/{id}', 'SeoSettingUpdate')->name('seo-update-setting');
    });
});

// Admin Return Order Routes
Route::prefix('return')->group(function () {
    Route::controller(ReturnController::class)->group(function () {
        Route::get('/admin/request', 'ReturnRequest')->name('return-request');
        Route::get('/admin/all/request', 'ReturnAllRequest')->name('all-request');
        Route::get('/admin/return/approved/{id}', 'ReturnRequestApproved')->name('return-approved');
    });
});


// Admin Orders All Routes Start Here
Route::prefix('orders')->group(function () {

    Route::controller(OrderController::class)->group(function () {

        Route::get('/pending/orders', 'PendingOrders')->name('pending-orders');
        Route::get('/pending/orders/detail/{id}', 'PendingOrdersDetails')->name('pending-order-details');
        Route::get('/confirm/orders', 'ConfirmOrder')->name('confirm-orders');
        Route::get('/processing/orders', 'ProcessingOrder')->name('processing-orders');
        Route::get('/picked/orders', 'PickedOrder')->name('picked-orders');
        Route::get('/shipped/orders', 'ShippedOrder')->name('shipped-orders');
        Route::get('/delivered/orders', 'DeliveredOrder')->name('delivered-orders');
        Route::get('/cancel/orders', 'CancelOrder')->name('cancel-orders');

        // Update Order Status
        Route::get('/confirm/order/{id}', 'PendingToConfirmOrder')->name('confirm-order');
        Route::get('/processing/order/{id}', 'ConfirmToProcessingOrder')->name('confirm-processing');
        Route::get('/picked/order/{id}', 'ProcessingToPickedOrder')->name('processing-picked');
        Route::get('/shipped/order/{id}', 'PickedToShippedOrder')->name('picked-shipped');
        Route::get('/delivered/order/{id}', 'ShippedToDeliveredOrder')->name('shipped-delivered');
        Route::get('/cancel/order/{id}', 'DeliveredToCancelOrder')->name('delivered-cancel');
        Route::get('/invoice/pdf/{id}', 'ConfirmInvoicePdf')->name('invoice-pdf');
    });
});


// Admin Shipping All Routes Start Here
Route::prefix('shipping')->group(function () {

    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/division/view', 'DivisionView')->name('manage-division');
        Route::get('/division/edit/{id}', 'DivisionEdit')->name('division.edit');
        Route::get('/division/delete/{id}', 'DivisionDelete')->name('division.delete');


        Route::post('/division/store', 'DivisionStore')->name('division.store');
        Route::post('/division/update/{id}', 'DivisionUpdate')->name('division.update');

        // -------------------------------- Ship District -----------------------------------------//

        Route::get('/district/view', 'DistrictView')->name('manage-district');
        Route::get('/district/edit/{id}', 'DistrictEdit')->name('district.edit');
        Route::get('/district/delete/{id}', 'DistrictDelete')->name('district.delete');



        Route::post('/district/store', 'DistrictStore')->name('district.store');
        Route::post('/district/update{id}', 'DistrictUpdate')->name('district.update');

        // -------------------------------- Ship State --------------------------//
        Route::get('/state/view', 'StateView')->name('manage-state');
        Route::get('/state/edit/{id}', 'StateEdit')->name('state.edit');
        Route::get('/state/delete/{id}', 'StateDelete')->name('state.delete');

        Route::post('/state/store', 'StateStore')->name('state.store');
        Route::post('/state/Update/{id}', 'StateUpdate')->name('state.update');
    });
});

// User All Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('dashboard', compact('user'));
    })->name('dashboard');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::get('/user/profile/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');


Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::post('user/update/change/password', [IndexController::class, 'UserPasswordUpdate'])->name('user.update.change.password');


//------------------------------Frontend All Routes Starts Here -------------------------//

// Multi Language All Routes Starts Here
Route::prefix('language')->group(function () {
    Route::controller(LanguageController::class)->group(function () {

        Route::get('/english', 'English')->name('english.language');
        Route::get('/urdu', 'Urdu')->name('urdu.language');
    });
});

// Product Reviews All Routes
Route::post('/reviews/store', [ReviewController::class, 'ReviewStore'])->name('review.store');

// Products Details Page All Routes
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Frontend Product Tags Page
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Frontend SubCategory Wise Data All Routes Start Here
Route::get('subcategory/product/{sub_id}/{slug}', [IndexController::class, 'SubCategoryWiseProduct']);

// Frontend SubCategory Wise Data All Routes Start Here
Route::get('subsubcategory/product/{subsub_id}/{slug}', [IndexController::class, 'subSubCategoryWiseProduct']);

// Product View Model with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add To Cart All Routes
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get data form MiniCart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// Remove Mini Cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishList']);


Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    // Get Wishlist All Routes
    Route::get('/wishlist', [WishlistController::class, 'ViewWishList'])->name('wishlist');
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishlistProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishlistProduct']);
    Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
    Route::get('/get-cart-product', [CartPageController::class, 'GetCartProduct']);
    Route::get('/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);


    Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
    Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

    // Checkout Routes
    Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');
    Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

    Route::get('/my/order', [AllUserController::class, 'MyOrder'])->name('my.order');


    Route::get('/order/details/{id}', [AllUserController::class, 'OrderDetails'])->name('order-detail');
    Route::get('/invoice/download/{id}', [AllUserController::class, 'InvoiceDownload'])->name('invoice-download');

    Route::post('/return/order/{id}', [AllUserController::class, 'ReturnOrder'])->name('return-order');
    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return-order-list');
    Route::get('/cancel/order', [AllUserController::class, 'CancelOrder'])->name('cancel-order');

    // Order Tracking Route
    Route::post('/order/tacking', [AllUserController::class, 'OrderTracking'])->name('order-tacking');
});

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);
Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);
// Product Search Routes
Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product-search');

// Advance Search Rout
Route::post('search-product', [IndexController::class, 'AdvanceProductSearch']);

// Shop Page Route Start Here
Route::get('/shop', [ShopController::class, 'ShopPage'])->name('shop-page');
Route::post('/shop/filter', [ShopController::class, 'ShopFilter'])->name('shop-filter');