@extends('e-commerce.layouts.master')
@section('title')
    الرئيسية
@endsection
@section('PageContent')



<main class="main-wrapper">

    <!-- Start Slider Area -->
    <div class="axil-main-slider-area main-slider-style-2">
        <div class="container">
            <div class="slider-offset-left">
                <div class="row row--20">
                    <div class="col-lg-12">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                            <div class="carousel-inner">

                                @php
                                    $sliderIndex = 0;
                                @endphp
                                @foreach (getSliders() as $slider)
                                    <div class="carousel-item @if($sliderIndex == 0) active @endif" >
                                        <img src="{{ $slider->display_image }}" class="slider_image d-block w-100">
                                    </div>
                                    @php
                                        $sliderIndex++
                                    @endphp
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slider Area -->


    <!-- Start New Arrivals Product Area  -->
    <div class="axil-new-arrivals-product-area bg-color-white axil-section-gap pb--0" style="margin-top:100px;">
        <div class="container">
            <div class="product-area pb--50">

                <div class="section-title-border slider-section-title">
                    <h2 class="title">المضاف حديثا 💫 </h2>
                </div>

                <div class="new-arrivals-product-activation slick-layout-wrapper--30 axil-slick-arrow  arrow-top-slide">

                    @foreach (\App\Models\Product::Tenancy()->orderBy('id','desc')->take("8")->get() as $Nproduct)
                        @include('e-commerce.component.product2',["product"=>$Nproduct])
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <!-- End New Arrivals Product Area  -->


    <!-- Start Expolre Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gap" style="margin-bottom:0px;">
        <div class="container">
            <div class="section-title-border slider-section-title">
                <h2 class="title">الأكثر مبيعا ⚡</h2>
            </div>
            <div class="explore-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-arrow arrow-top-slide">
                <div class="slick-single-layout">
                    <div class="row row--15">

                        @php
                            $products = [];
                            $orders = \App\Models\Order::Tenancy()->count();
                            if($orders > 0) {
                                $products = \App\Models\Product::Tenancy();
                                // $ids = \DB::table('e_products')
                                //     ->leftJoin('e_order_items','e_products.id','=','e_order_items.product_id')
                                //     ->selectRaw('e_products.* ,COALESCE(sum(e_order_items.qty),0) total')
                                //     ->groupBy('e_products.id')
                                //     ->orderBy('total','desc')
                                //     ->pluck("id")->toArray();
                                $products = $products->orderBy("id","desc")->take(8)->get();
                            }
                        @endphp
                        @foreach ($products as $product)
                            @include('e-commerce.component.product',["product"=>$product])
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center mb--20 mt_sm--0">
                    <a href="{{ makeRoute('products.index') }}" class="axil-btn btn-bg-lighter btn-load-more">عرض كل المنتجات</a>
                </div>
            </div>



        </div>
    </div>
    <!-- End Expolre Product Area  -->

    <!-- Start Expolre Product Area  -->
    <div class="axil-product-area bg-color-white axil-section-gapcommon">
        <div class="container">
            <div class="section-title-border slider-section-title">
                <h2 class="title">منتجات مميزة 💥</h2>
            </div>
            <div class="popular-product-activation slick-layout-wrapper slick-layout-wrapper--15 axil-slick-angle angle-top-slide">
                <div class="slick-single-layout">
                    <div class="row">

                        @foreach (\App\Models\Product::Tenancy()->where('star',1)->orderBy('id','desc')->take("4")->get() as $Sproduct)
                            <div class="col-md-6 col-12">
                                <div class="axil-product product-style-eight product-list-style-3">
                                    <div class="thumbnail">
                                        <a href="{{ makeRoute('products.show',[$Sproduct->id]) }}">
                                            <img style="height: 280px;width:280px" class="main-img" src="{{ $Sproduct->display_image }}" alt="{{ $Sproduct->name }}">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <div class="inner">
                                            <div class="product-cate">
                                                {{ $Sproduct->categories()->whereNotNull("parent_id")->first()->name }}
                                            </div>
                                            <h5 class="title"><a href="{{ makeRoute('products.show',[$Sproduct->id]) }}">{{ $Sproduct->name }}</a></h5>
                                            <div class="product-rating">
                                                <span class="icon">
                                                    @for ($i=0; $i < $Sproduct->rate ;$i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @for ($i=5;$i > $Sproduct->rate;$i--)
                                                        <i class="far fa-star" style=" color: black; "></i>
                                                    @endfor
                                                </span>
                                                <span class="rating-number">{{ $Sproduct->rate }}</span>
                                            </div>
                                            <div class="product-price-variant">
                                                <span class="price-text"></span>
                                                <span class="price current-price"> {{ ($Sproduct->offer != 0) ? $Sproduct->offer : $Sproduct->price }} ر.س</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="label-block label-right">
                                        <div class="product-badget">منتج مميز</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Expolre Product Area  -->



</main>



@endsection
