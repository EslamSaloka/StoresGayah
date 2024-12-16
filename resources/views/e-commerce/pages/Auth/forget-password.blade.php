@extends('e-commerce.layouts.master')
@section('title')
    نسيت كلمة المرور
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
                            <li class="axil-breadcrumb-item active" aria-current="page">نسيت كلمة المرور</li>
                        </ul>
                        <h1 class="title">نسيت كلمة المرور</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Shop Area  -->
    <div class="axil-shop-area axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-xl-4">
                    <div class="axil-signin-form-wrap">
                        <div class="axil-signin-form">
                            <h3 class="title">مرحبا بك في متجر {{ getStoreInformation("store_name") }}</h3>
                            <p class="b2 mb--55">اكتب رقم جوالك المسجل بالمتجر</p>
                            <form class="singin-form SendDataForm" action="{{ makeRoute('forget-password.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>رقم الجوال</label>
                                    <input type="text" class="form-control inputD" name="phone" placeholder="05XXXXXXXX">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="axil-btn btn-bg-primary submit-btn" style="width:100%;">متابعة </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #f6f7fb;height:2px;margin-top:50px;"></div>
    </div>
    <!-- End .container -->
    </div>
    <!-- End Shop Area  -->

</main>

@endsection
