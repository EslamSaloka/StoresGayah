@extends('e-commerce.layouts.master')
@section('title')
    المفضلة
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
                            <li class="axil-breadcrumb-item active" aria-current="page">قائمة الأمنيات</li>
                        </ul>
                        <h1 class="title">قائمة الأمنيات</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    @if ($products->count() > 0)
        <!-- Start Wishlist Area  -->
        <div class="axil-wishlist-area axil-section-gap">
            <div class="container">
                <div class="product-table-heading">
                </div>
                <div class="table-responsive">
                    <table class="table axil-product-table axil-wishlist-table">
                        <thead>
                        <tr>
                            <th scope="col" class="product-remove"></th>
                            <th scope="col" class="product-thumbnail">المنتج</th>
                            <th scope="col" class="product-title"></th>
                            <th scope="col" class="product-price">السعر</th>
                            <th scope="col" class="product-stock-status">حالة التوافر</th>
                            <th scope="col" class="product-add-cart"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr id="fav_{{ $product->id }}">
                                    <td class="product-remove">
                                        <a href="javascript:void(0);" class="remove-wishlist callAction" data-id="{{$product->id}}" data-action="fav">
                                            <i class="fal fa-times"></i>
                                        </a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="{{ makeRoute('products.show',[$product->id]) }}">
                                        <img src="{{ $product->display_image }}" alt="{{ $product->name }}">
                                    </a>
                                    </td>
                                    <td class="product-title"><a href="{{ makeRoute('products.show',[$product->id]) }}">{{ $product->name }}</a></td>
                                    <td class="product-price" data-title="السعر"><span class="currency-symbol">{{ $product->price }} ر.س</span></td>
                                    <td class="product-stock-status" data-title="الحالة">
                                        @if ($product->qty > 0)
                                            متوفرة
                                        @else
                                            غير متوفرة
                                        @endif
                                    </td>
                                    <td class="product-add-cart">
                                        @if ($product->qty > 0)
                                            <a href="javascript:void(0);" class="axil-btn btn-outline callAction" data-id="{{$product->id}}" data-action="cart">إضافة للسلة</a>
                                        @else
                                            <a href="javascript:void(0);" class="axil-btn btn-outline callAction">غير متوفر</a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Wishlist Area  -->
    @else

    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">

                <div style="text-align:center;margin:100px 0px;">
                    <img src="{{ url('/assets/images/cart_empty.gif') }}" style="height:250px;width:250px;margin-bottom:30px;">
                    <p>
                        لا يوجد منتجات في المفضلة
                    </p>
                    <br>
                    <a href="{{ makeRoute('home') }}" class="axil-btn btn-bg-primary checkout-btn">تسوق الان</a>
                </div>
            </div>
        </div>
    </div>

    @endif
</main>


@endsection
