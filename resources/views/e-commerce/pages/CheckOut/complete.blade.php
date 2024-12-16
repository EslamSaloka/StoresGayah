@extends('e-commerce.layouts.master')
@section('title')
    تم استلام طلبك
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
                            <li class="axil-breadcrumb-item active" aria-current="page">تم استلام طلبك</li>
                        </ul>
                        <h1 class="title">تم استلام طلبك</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->


    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap" style="text-align:center;">
               <i class="fa fa-check mb--20 success_order" style="font-size:80px;color:white;padding:30px;border-radius:50%;"></i>
                <h2>تهانينا</h2>
                <p style="font-size:30px;margin-bottom:5px;">تم استلام طلبك بنجاح</p>
                <p style="font-size:30px;margin-bottom:40px;">رقم الطلب : {{ $ID }}</p>
                <a href="{{ makeRoute('profile.index') }}" class="axil-btn btn-bg-primary checkout-btn">صفحة طلباتي</a>
            </div>
        </div>
    </div>

    <div class="row" style="background-color: #f6f7fb;height:2px;margin-bottom: 40px;"></div>

</main>


@endsection

