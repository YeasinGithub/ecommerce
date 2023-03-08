<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fontend\IndexController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ShippingAreaController;


use App\Http\Controllers\Fontend\LanguageController;
use App\Http\Controllers\Fontend\CartController;
use App\Http\Controllers\SslCommerzPaymentController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*-----------------------admin route-----------------------------*/
Route::group(['prefix'=>'admin', 'middleware' =>['admin', 'auth'], 'namespace'=>'Admin'], function(){
	Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
	/*-profile-*/
	Route::get('profile', [AdminController::class, 'profile'])->name('profile');
	Route::post('updated-profile', [AdminController::class, 'profileUpdate'])->name('updated-profile');
	Route::get('image', [AdminController::class, 'updateImgPage'])->name('image');
	Route::post('updated-image', [AdminController::class, 'updateImg'])->name('updated-image');
	Route::get('change-password', [AdminController::class, 'updatePass'])->name('change-password');
	Route::post('change-password/save', [AdminController::class, 'updatePassStore'])->name('change-password.save');
	/*-----------brands------------*/
	Route::get('brand', [BrandController::class, 'index'])->name('brand');
	Route::post('brand-store', [BrandController::class, 'store'])->name('brand-store');
	Route::get('brand-edit/{brand_id}', [BrandController::class, 'edit']);
	Route::post('update-brand', [BrandController::class, 'brandUpdate'])->name('update-brand');
	Route::get('brand-delete/{brand_id}', [BrandController::class, 'delete']);
	/*-----------category------------*/
	Route::get('category', [CategoryController::class, 'index'])->name('category');
	Route::post('category-store', [CategoryController::class, 'store'])->name('category-store');
	Route::get('category-edit/{cat_id}', [CategoryController::class, 'edit']);
	Route::post('update-category', [CategoryController::class, 'update'])->name('update-category');
	Route::get('category-delete/{catDel_id}', [CategoryController::class, 'delete']);
	/*-----------sub-category------------*/
	Route::get('sub-category', [CategoryController::class, 'subIndex'])->name('sub-category');
	Route::post('sub-category-store', [CategoryController::class, 'Substore'])->name('sub-category-store');
	Route::get('sub-category-edit/{subCat_id}', [CategoryController::class, 'subEdit']);
	Route::post('update-sub-category', [CategoryController::class, 'updateSub'])->name('update-sub-category');
	Route::get('sub-category-delete/{subCatDel_id}', [CategoryController::class, 'subDelete']);
	/*-----------sub-sub category------------*/
	Route::get('sub-sub-category', [CategoryController::class, 'subsubIndex'])->name('sub-sub-category');
	Route::get('subcategory/ajax/{cat_id}',[CategoryController::class,'getSubCat']);
	Route::post('sub-sub-category/store',[CategoryController::class,'subSubCategoryStore'])->name('sub-subcategory-store');
	Route::get('sub-sub-category-edit/{subsubcat_id}',[CategoryController::class,'subSubEdit']);
    Route::post('sub-subcategory/update',[CategoryController::class,'subSubCatUpdate'])->name('update-sub-subcategory');
    Route::get('sub-sub-category-delete/{subsubcat_id}',[CategoryController::class,'subSubDelete']);
    /*-----------product route------------*/
    Route::get('add-product',[ProductController::class,'addProduct'])->name('add-product');
    Route::post('product/store',[ProductController::class,'store'])->name('store-product');
    Route::get('sub-subcategory/ajax/{subcat_id}',[ProductController::class,'getSubSubCat']);
    Route::get('manage-product',[ProductController::class,'manageProduct'])->name('manage-product');
    Route::get('/product-edit/{product_id}',[ProductController::class,'edit']);
    Route::post('product/data-update',[ProductController::class,'productDataUpdate'])->name('update-product-data');
    Route::post('product/thambnail/update',[ProductController::class,'thambnailUpdate'])->name('update-product-thambnail');
    Route::post('product/multi-image/update',[ProductController::class,'multiImagUpdate'])->name('update-product-image');
    Route::get('product/multiimg/delete/{id}',[ProductController::class,'multiImageDelete']);
    Route::get('product-active/{id}', [ProductController::class,'active']);
    Route::get('product-inactive/{id}', [ProductController::class,'inactive']);
    Route::get('/product-delete/{product_id}',[ProductController::class,'delete']);

	//sliders
    Route::get('slider',[SliderController::class,'index'])->name('sliders');
    Route::post('slider/store',[SliderController::class,'store'])->name('slider-store');
    Route::get('slider-edit/{id}',[SliderController::class,'edit']);
    Route::post('slider/update',[SliderController::class,'update'])->name('update-slider');
    Route::get('slider/delete/{id}',[SliderController::class,'destroy']);
    Route::get('slider-inactive/{id}',[SliderController::class,'inactive']);
    Route::get('slider-active/{id}',[SliderController::class,'active']);
    //coupon
    Route::get('coupon',[CouponController::class,'create'])->name('coupon');
    Route::post('coupon/store',[CouponController::class,'store'])->name('coupon-store');
    Route::get('coupon-edit/{id}',[CouponController::class,'edit']);
    Route::post('coupon/update',[CouponController::class,'update'])->name('coupon-update');
    Route::get('coupon-delete/{id}',[CouponController::class,'destroy']);
    /*----shipping area-----*/
    //division
    Route::get('division',[ShippingAreaController::class,'createDivision'])->name('division');
    Route::post('division/store',[ShippingAreaController::class,'divisionStore'])->name('division-store');
    Route::get('division-edit/{id}',[ShippingAreaController::class,'divisionEdit']);
    Route::post('division/update',[ShippingAreaController::class,'divisionUpdate'])->name('division-update');
    Route::get('division-delete/{id}',[ShippingAreaController::class,'divisionDestroy']);
    //district
    Route::get('district',[ShippingAreaController::class,'districtCreate'])->name('district');
    Route::post('district/store',[ShippingAreaController::class,'districtStore'])->name('district-store');
    Route::get('district-edit/{id}',[ShippingAreaController::class,'districtEdit']);
    Route::post('district/update',[ShippingAreaController::class,'districtUpdate'])->name('district-update');
    Route::get('district-delete/{id}',[ShippingAreaController::class,'districtDestroy']);
    //state
    Route::get('state',[ShippingAreaController::class,'stateCreate'])->name('state');
    Route::get('district-get/ajax/{division_id}',[ShippingAreaController::class,'getDistrictAjax']);
    Route::post('state/store',[ShippingAreaController::class,'stateStore'])->name('state-store');
    Route::get('state-edit/{id}',[ShippingAreaController::class,'stateEdit']);
    Route::post('state/update',[ShippingAreaController::class,'stateUpdate'])->name('state-update');
    Route::get('state-delete/{id}',[ShippingAreaController::class,'stateDestroy']);

    
});

/*-------------Frontend Route------------------*/
Route::get('language/bangla',[LanguageController::class,'bangla'])->name('bangla.language');
Route::get('language/english',[LanguageController::class,'english'])->name('english.language');
Route::get('single/product/{id}/{slug}',[IndexController::class,'singleProduct']);
//product tags
Route::get('product/tag/{tag}',[IndexController::class,'tagWiseProduct']);
//subcategory wise product show
Route::get('subcategory/product/{subcat_id}/{slug}',[IndexController::class,'subCatWiseProduct']);
Route::get('sub/subcategory/product/{subsubcat_id}/{slug}',[IndexController::class,'subSubCatWiseProduct']);
//product view modal with ajax
Route::get('product/view/modal/{id}',[IndexController::class,'productViewAjax']);
// add to cart
Route::post('/cart/data/store/{id}',[CartController::class,'addToCart']);
//mini cart
Route::get('product/mini/cart',[CartController::class,'miniCart']);
Route::get('/minicart/product-remove/{rowId}',[CartController::class,'miniCartRemove']);

//wishlist
Route::post('/add-to-wishlist/{product_id}',[CartController::class,'addToWishlist']);



/*------------------------user route-----------------------------*/
Route::group(['prefix'=>'user', 'middleware' =>['user', 'auth'], 'namespace'=>'User'], function()
	{
	Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
	/*--profile---*/
	Route::post('update/data', [UserController::class, 'updateData'])->name('update-profile');
	Route::get('image', [UserController::class, 'imagePage'])->name('user-image');
	Route::post('update/image', [UserController::class, 'updateImage'])->name('update-image');
	Route::get('update/password', [UserController::class, 'updatePassPage'])->name('update-password');
	Route::post('update/password/save/', [UserController::class, 'updatePassSave'])->name('update.password.save');
	
	//wishlist
    Route::get('wishlist',[WishlistController::class,'create'])->name('wishlist');
    Route::get('/get-wishlist-product',[WishlistController::class,'readAllProduct']);
    Route::get('/wishlist-remove/{id}',[WishlistController::class,'destory']);
    //checkout
    Route::get('district-get/ajax/{division_id}',[CheckoutController::class,'getDistrictWithAjax']);
    Route::get('state-get/ajax/{district_id}',[CheckoutController::class,'getStateWithAjax']);
    Route::post('payment',[CheckoutController::class,'storeCheckout'])->name('user.checkout.store');
    //stripe payment
    Route::post('stripe/order-complete',[StripeController::class,'store'])->name('stripe.order');
});
	//cart
	 Route::get('my-cart',[CartController::class,'create'])->name('cart');
	 Route::get('/get-cart-product',[CartController::class,'getAllCart']);
	 Route::get('/cart-remove/{rowId}',[CartController::class,'destory']);
	 Route::get('/cart-increment/{rowId}',[CartController::class,'cartIncrement']);
	 Route::get('/cart-decrement/{rowId}',[CartController::class,'cartDecrement']);
	//coupon
	 Route::post('/coupon-apply',[CartController::class,'couponApply']);
	 Route::get('coupon-calculation',[CartController::class,'couponCalcaultion']);
	 Route::get('coupon-remove',[CartController::class,'removeCoupon']);
	//checkout
	Route::get('user/checkout',[CartController::class,'checkoutCreate'])->name('checkout');

	// SSLCOMMERZ Start
	Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
	Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

	Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
	Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

	Route::post('/success', [SslCommerzPaymentController::class, 'success']);
	Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
	Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

	Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
	//SSLCOMMERZ END


/**/
/*@extends('layouts.fontend_master')
@section('content')
    @section('title') {{ $product->product_name_en }} @endsection
@section('meta')
    <meta property="og:title" content="{{ $product->product_name_en }}" />
    <meta property="og:url" content="{{ Request::fullUrl() }}" />
    <meta property="og:image" content="{{ URL::to($product->product_thambnail) }}" />
    <meta property="og:description" content="{{ $product->short_descp_en }}" />
    <meta property="og:site_name" content="Shopmama" />
@endsection
@php
function bn_price($str)
{
    $en = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
    $bn = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'];
    $str = str_replace($en, $bn, $str);
    return $str;
}
@endphp

<div id="app">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li class='active'>Floral Print Buttoned</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
                            <img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
                        </div>

                        <!-- =============== HOT DEALS ================ -->
                        @include('fontend.inc.hot-deals')
                        <!-- ======== HOT DEALS: END ======================= -->

                    <!-- ======================= NEWSLETTER ========================== -->
                        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                            <h3 class="section-title">Newsletters</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <p>Sign Up for Our Newsletter!</p>
                                <form role="form">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Subscribe to our newsletter">
                                    </div>
                                    <button class="btn btn-primary">Subscribe</button>
                                </form>
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ========================== NEWSLETTER: END =============== -->

                        <!-- =================== Testimonials============= -->
                        <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
                            <div id="advertisement" class="advertisement">
                                <div class="item">
                                    <div class="avatar"><img
                                            src="{{ asset('fontend') }}/assets/images/testimonials/member1.png"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                    <!-- /.container-fluid -->
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img
                                            src="{{ asset('fontend') }}/assets/images/testimonials/member3.png"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                                </div><!-- /.item -->

                                <div class="item">
                                    <div class="avatar"><img
                                            src="{{ asset('fontend') }}/assets/images/testimonials/member2.png"
                                            alt="Image"></div>
                                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port
                                        mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                                    <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                    <!-- /.container-fluid -->
                                </div><!-- /.item -->

                            </div><!-- /.owl-carousel -->
                        </div>
                        <!-- ================== Testimonials: END =========================== -->
                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        @foreach ($multiImgs as $img)
                                            <div class="single-product-gallery-item" id="slide{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ asset($img->photo_name) }}">
                                                    <img class="img-responsive" alt=""
                                                        src="{{ asset($img->photo_name) }}"
                                                        data-echo="{{ asset($img->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach

                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            @foreach ($multiImgs as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb" data-target="#owl-single-product"
                                                        data-slide="{{ $img->id }}" href="#slide{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ asset($img->photo_name) }}"
                                                            data-echo="{{ asset($img->photo_name) }}" />
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->

                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pname">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->product_name_bn }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </h1>

                                    <div class="rating-reviews m-t-20">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="rating rateit-small"></div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="reviews">
                                            <a href="#" class="lnk">(13 Reviews)</a>
                                        </div>
                                    </div>
                                </div><!-- /.row -->        
                            </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">In Stock</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if (session()->get('language') == 'bangla')
                                            {!! $product->short_descp_bn !!}
                                        @else
                                            {!! $product->short_descp_en !!}
                                        @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">


                                            <div class="col-sm-6">
                                           
                                            @auth

                                            <send-message  
                                                    :receiver-id="{{ $product->user_id }}" 
                                                    receiver-name="{{ $product->user->name }}"
                                                    :product-id="{{ $product->id }}"
                                                    ></send-message>
                                                @else
                                               <h4 class="text-danger">Chat This Seller To <a href="{{ route('login') }}" target="_blank">Login</a> Your Account</h4>
                                            @endauth

                                                <div class="price-box">
                                                    @if ($product->discount_price == null)
                                                        @if (session()->get('language') == 'bangla')
                                                            <span
                                                                class="price">${{ bn_price($product->selling_price) }}</span>
                                                        @else
                                                            <span class="price">${{ $product->selling_price }}</span>
                                                        @endif
                                                    @else
                                                        @if (session()->get('language') == 'bangla')
                                                            <span
                                                                class="price">${{ bn_price($product->discount_price) }}</span>
                                                            <span
                                                                class="price-strike">${{ bn_price($product->selling_price) }}</span>
                                                        @else
                                                            <span class="price">${{ $product->discount_price }}</span>
                                                            <span
                                                                class="price-strike">${{ $product->selling_price }}</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    {{-- //product share --}}
                                                    <div class="sharethis-inline-share-buttons"
                                                        data-href="{{ Request::url() }}"></div>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                        <div class="row mt-3">


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="color">Select Color</label>
                                                    <select class="form-control" id="color">
                                                        @foreach ($product_color_en as $color)
                                                            <option value="{{ $color }}">{{ ucwords($color) }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                @if ($product->product_size_en == null)
                                                @else
                                                    <div class="form-group">
                                                        <label for="size">Select Size</label>
                                                        <select class="form-control" id="size">
                                                            @foreach ($product_size_en as $size)
                                                                <option value="{{ $size }}">{{ ucwords($size) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" id="qty" value="1" min="1">
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="product_id" value="{{ $product->id }}">

                                            <div class="col-sm-7">
                                                <button type="submit" onclick="addToCart()" class="btn btn-primary"><i
                                                        class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->

                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    <li><a data-toggle="tab" href="#tags">Comments</a></li>

                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                @if (session()->get('language') == 'bangla')
                                                    {!! $product->long_descp_bn !!}
                                                @else
                                                    {!! $product->long_descp_en !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">
                                            <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>

                                            <div class="reviews">
                                                <div class="review">
                                                    <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                                    <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                                </div>
                                            
                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->
                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">
                                            <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="10">
                                            </div>
                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Related Products</h3>
                        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                            @foreach ($relatedProducts as $product)
                                <div class="item item-carousel">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image">
                                                    @if (session()->get('language') == 'bangla')
                                                        <a
                                                            href="{{ url('single/product/' . $product->id . '/' . $product->product_slug_bn) }}"><img
                                                                src="{{ asset($product->product_thambnail) }}"
                                                                alt=""></a>
                                                    @else
                                                        <a
                                                            href="{{ url('single/product/' . $product->id . '/' . $product->product_slug_en) }}"><img
                                                                src="{{ asset($product->product_thambnail) }}"
                                                                alt=""></a>
                                                    @endif
                                                </div><!-- /.image -->
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount / $product->selling_price) * 100;
                                                @endphp
                                                <div class="tag new">
                                                    @if ($product->discount_price == null)
                                                        <span>
                                                            @if (session()->get('language') == 'bangla') নতুন
                                                            @else new @endif
                                                        </span>
                                                    @else
                                                        <span>
                                                            @if (session()->get('language') == 'bangla')
                                                            {{ bn_price(round($discount)) }}% @else
                                                                {{ round($discount) }}% @endif
                                                        </span>
                                                    @endif
                                                </div>
                                            </div><!-- /.product-image -->


                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    @if (session()->get('language') == 'bangla')
                                                        <a href="detail.html">{{ $product->product_name_bn }}</a>
                                                    @else
                                                        <a href="detail.html">{{ $product->product_name_en }}</a>
                                                    @endif
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    @if ($product->discount_price == null)
                                                        @if (session()->get('language') == 'bangla')
                                                            <span
                                                                class="price">${{ bn_price($product->selling_price) }}</span>
                                                        @else
                                                            <span class="price">${{ $product->selling_price }}</span>
                                                        @endif
                                                    @else
                                                        @if (session()->get('language') == 'bangla')
                                                            <span
                                                                class="price">${{ bn_price($product->discount_price) }}</span>
                                                            <span
                                                                class="price-before-discount">${{ bn_price($product->selling_price) }}</span>
                                                        @else
                                                            <span class="price">${{ $product->discount_price }}</span>
                                                            <span
                                                                class="price-before-discount">${{ $product->selling_price }}</span>
                                                        @endif

                                                    @endif

                                                </div><!-- /.product-price -->
                                            </div><!-- /.product-info -->
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" type="button"
                                                                title="Add Cart" data-toggle="modal"
                                                                data-target="#cartModal" id="{{ $product->id }}"
                                                                onclick="productView(this.id)">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">
                                                                @if (session()->get('language') == 'bangla')
                                                                কার্টেসংযুক্ত করুন@else Add to cart @endif>
                                                            </button>
                                                        </li>
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Add to WIshlist" id="{{ $product->id }}"
                                                            onclick="addToWishlist(this.id)">
                                                            <i class="icon fa fa-heart"></i>
                                                        </button>
                                                    </ul>
                                                </div><!-- /.action -->
                                            </div><!-- /.cart -->
                                        </div><!-- /.product -->
                                    </div><!-- /.products -->
                                </div><!-- /.item -->
                            @endforeach

                        </div><!-- /.home-owl-carousel -->
                    </section><!-- /.section -->
                    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
</div>
  <script src="{{ asset('js/app.js') }}" defer></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0&appId=157782379562934&autoLogAppEvents=1"
    nonce="WhS30MCS"></script>

{{-- // share products --}}
<script type="text/javascript"
    src="https://platform-api.sharethis.com/js/sharethis.js#property=609aecbaf811a40018fa1e32&product=inline-share-buttons"
    data-href="{{ Request::url() }}" async="async"></script>
@endsection
*/