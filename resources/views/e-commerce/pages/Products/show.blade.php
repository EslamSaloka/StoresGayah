@extends('e-commerce.layouts.master')
@section('title')
    {{ $product->name }}
@endsection
@section('PageContent')

<main class="main-wrapper">
    <!-- Start Breadcrumb Area  -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="{{ makeRoute('home') }}">الرئيسية</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">تفاصيل المنتج</li>
                        </ul>
                        <h1 class="title" style="font-size:25px;">
                            {{ $product->name }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Shop Area  -->
    <div class="axil-single-product-area axil-section-gap pb--0 bg-color-white">
        <div class="single-product-thumb mb--40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 mb--40">
                        <div class="row">
                            <div class="col-lg-10 order-lg-2">
                                <div class="single-product-thumbnail-wrap zoom-gallery">
                                    <div class="single-product-thumbnail product-large-thumbnail-3 axil-product">

                                        @foreach ($product->images()->get() as $image)
                                            <div class="thumbnail">
                                                <a href="{{ $image->display_image }}" class="popup-zoom">
                                                    <img src="{{ $image->display_image }}" alt="Product Images">
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="product-quick-view position-view">
                                        <a href="{{ $product->display_image }}" class="popup-zoom">
                                            <i class="far fa-search-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 order-lg-1">
                                <div class="product-small-thumb-3 small-thumb-wrapper">
                                    @foreach ($product->images()->get() as $image)
                                        <div class="small-thumb-img">
                                            <img src="{{ $image->display_image }}" alt="thumb image">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb--40">
                        <div class="single-product-content">
                            <div class="inner">
                                <h2 class="product-title">
                                    {{ $product->name }}
                                </h2>
                                <span class="price-amount">{{ ($product->offer == 0) ? $product->price : $product->offer }} ر.س </span>
                                <div class="product-rating">
                                    <div class="star-rating">
                                        @for ($i=0; $i < $product->rate ;$i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for ($i=5;$i > $product->rate;$i--)
                                            <i class="far fa-star" style=" color: black; "></i>
                                        @endfor
                                    </div>
                                    <div class="review-link">
                                        <a href="#">(<span>{{ $product->rates()->count() }}</span> تقييمات المستخدمين )</a>
                                    </div>
                                </div>
                                <ul class="product-meta">
                                    <li>
                                        <i class="fal fa-check"></i>
                                        @if ($product->qty == 0)
                                            غير متوفر
                                        @else
                                            متوفر
                                        @endif
                                    </li>
                                    {{-- <li><i class="fal fa-check"></i>شحن مجاني للطلبات بقيمة 500 ريال واكثر</li>
                                    <li><i class="fal fa-check"></i>استمتع بكود خصم بقيمة 30% : MOTIVE30</li> --}}
                                </ul>
                                <p class="description">
                                    {{ $product->short_description }}{{ $product->short_description }}
                                </p>

                                <div class="product-variations-wrapper">


                                    <!-- Start Product Variation  -->
                                    <div class="product-variation product-size-variation">
                                        <h6 class="title">الوزن :</h6>
                                        <ul class="range-variant">
                                            <li>{{ $product->weight }} كجم</li>
                                        </ul>
                                    </div>
                                    <!-- End Product Variation  -->
                                </div>

                                <!-- Start Product Action Wrapper  -->
                                <div class="product-action-wrapper d-flex-center">
                                    <!-- Start Product Action  -->
                                    <ul class="product-action d-flex-center mb--0">
                                        @if ($product->qty != 0)


                                            @if (\Auth::check())
                                                @php
                                                    $cart = (new \App\Support\Cart);
                                                    $addcart        = true;
                                                    if($cart->getCount() > 0) {
                                                        if(is_numeric(array_search($product->id, array_column($cart->showItems(), 'id')))) {
                                                            $addcart        = false;
                                                        }
                                                    }
                                                @endphp
                                            @else
                                                @php
                                                    $addcart = true;
                                                @endphp
                                            @endif

                                            <li class="add-to-cart">
                                                @if ($addcart == false)
                                                    <button disabled href="javascript:void(0);" class="axil-btn btn-bg-primary">
                                                        تم الإضافه
                                                    </button>
                                                @else
                                                    <a href="javascript:void(0);" class="axil-btn btn-bg-primary callAction" data-id="{{$product->id}}" data-action="cart">
                                                        إضافة للسلة
                                                    </a>
                                                @endif
                                            </li>

                                        @else

                                        <li class="add-to-cart">
                                            <button disabled href="javascript:void(0);" class="axil-btn btn-bg-primary">
                                                غير متوفر
                                            </button>
                                        </li>

                                        @endif
                                        <li class="wishlist">
                                            @if (\Auth::check())
                                                @php
                                                    $fav        = false;
                                                    $productIds = \Auth::user()->advFav()->where("store_id",getStoreIdFormTenancy())->pluck('product_id')->toArray();
                                                    if(in_array($product->id,$productIds)) {
                                                        $fav  = true;
                                                    }
                                                @endphp
                                            @else
                                                @php
                                                    $fav = false;
                                                @endphp
                                            @endif
                                            <a href="javascript:void(0);" class="axil-btn wishlist-btn callAction" data-id="{{$product->id}}" data-action="fav">
                                                <i class="far fa-heart" @if ($fav)
                                                style="color:{{ getStoreInformation('main_color') }}"
                                            @endif></i>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- End Product Action  -->

                                </div>
                                <!-- End Product Action Wrapper  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .single-product-thumb -->

        <div class="woocommerce-tabs wc-tabs-wrapper bg-vista-white">
            <div class="container">
                <ul class="nav tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">تفاصيل المنتج</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">تقييمات المنتج</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <div class="product-desc-wrapper">
                            <div class="row">
                                <div class="col-lg-12 mb--30">
                                    <div class="single-desc">
                                        <p>
                                            {!! nl2br($product->description) !!}
                                        </p>
                                        <!-- Start Product Variation  -->
                                        <div class="product-variation product-size-variation">
                                            <h6 class="title">ابعاد المنتج :</h6>
                                            <p style="direction:rtl;">
                                                <span>العرض : </span>{{ $product->width }} سم  -
                                                <span>الطول : </span>{{ $product->length }} سم


                                            </p>
                                        </div>

                                        <!-- End Product Variation  -->

                                    </div>
                                </div>
                            </div>
                            <!-- End .row -->
                        </div>
                        <!-- End .product-desc-wrapper -->
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        <div class="reviews-wrapper">
                            <div class="row">
                                <div class="col-lg-6 mb--40">
                                    <div class="axil-comment-area pro-desc-commnet-area">
                                        <h5 class="title">متاح  {{ $product->rate }} تقييمات لهذا المنتج</h5>
                                        <ul class="comment-list">

                                            @foreach ($product->rates()->get() as $rate)
                                                <!-- Start Single Comment  -->
                                                <li class="comment">
                                                    <div class="comment-body">
                                                        <div class="single-comment">
                                                            <div class="comment-img">
                                                                <img src="{{ $rate->client->display_image }}" style="height:60px;width:60px;" alt="Author Images">
                                                            </div>
                                                            <div class="comment-inner">
                                                                <h6 class="commenter">
                                                                    <a class="hover-flip-item-wrapper" href="#">
                                                                        <span class="hover-flip-item">
                                                                            <span data-text="Cameron Williamson">
                                                                                {{ $rate->client->name }}
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                    <span class="commenter-rating ratiing-four-star">
                                                                        @for ($i=0;$i<$rate->rate;$i++)
                                                                            <a href="#"><i class="fas fa-star"></i></a>
                                                                        @endfor
                                                                        @for ($i=5;$i > $rate->rate;$i--)
                                                                            <a href="#"><i class="fas fa-star empty-rating"></i></a>
                                                                        @endfor
                                                                    </span>
                                                                </h6>
                                                                <div class="comment-text">
                                                                    <p>
                                                                        {{ $rate->message }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Single Comment  -->
                                            @endforeach



                                        </ul>
                                    </div>
                                    <!-- End .axil-commnet-area -->
                                </div>
                                <!-- End .col -->
                                <div class="col-lg-6 mb--40">
                                    <!-- Start Comment Respond  -->
                                    <div class="comment-respond pro-des-commend-respond mt--0">
                                        <h5 class="title mb--30">اكتب تقييمك عن المنتج</h5>
                                        <p></p>
                                        <form method="POST" action="{{ makeRoute('products.comments.store',[$product->id]) }}" class="SendDataForm">
                                        <div class="rating-wrapper d-flex-center mb--40">عدد نجوم التقييم لهذا المنتج<span class="require">*</span>
                                            <div class="reating-inner ml--20">
                                                <select name="rate" id="" class="inputD">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>

                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>ما هو تقييمك عن المنتج</label>
                                                        <textarea name="message" class="inputD" placeholder="اكتب تقييمك هنا"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <button type="submit" id="submit" class="axil-btn btn-bg-primary w-auto">نشر التقييم</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Comment Respond  -->
                                </div>
                                <!-- End .col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- woocommerce-tabs -->

    </div>
    <!-- End Shop Area  -->


    <!-- Start Recently Viewed Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30" style="margin-top:50px;">
        <div class="container">
            @if ($products->count() > 0)
                <div class="section-title-wrapper">
                    <h2 class="title">منتجات مشابهة</h2>
                </div>
                <div class="recent-product-activation slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">

                    @foreach ($products as $product)
                        @include('e-commerce.component.product',["product"=>$product])
                    @endforeach

                </div>
            @endif

            <div class="row" style="background-color: #f6f7fb;height: 2px;margin-bottom:10px;margin-top:20px;"></div>

        </div>

    </div>
    <!-- End Recently Viewed Product Area  -->




</main>

@endsection
