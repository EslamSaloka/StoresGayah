@extends('e-commerce.layouts.master')
@section('title')
    تسجيل حساب جديد
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
                            <li class="axil-breadcrumb-item active" aria-current="page">تسجيل حساب جديد</li>
                        </ul>
                        <h1 class="title">تسجيل حساب جديد</h1>
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
                            <p class="b2 mb--55">الرجاء اكمال بيانات فتح الحساب</p>
                            <form class="singin-form SendDataForm" action="{{ makeRoute('register.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>الاسم</label>
                                    <input type="text" class="form-control inputD" name="name" placeholder="الاسم">
                                </div>
                                <div class="form-group">
                                    <label>رقم الجوال</label>
                                    <input type="text" class="form-control inputD" name="phone" placeholder="05XXXXXXXX">
                                </div>
                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input type="email" class="form-control inputD" name="email" placeholder="****@example.com">
                                </div>
                                <div class="form-group">
                                    <label>كلمة المرور</label>
                                    <input type="password" class="form-control inputD" name="password" placeholder="********">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="axil-btn btn-bg-primary submit-btn" style="width:100%;">تسجيل جديد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center dont-have">لديك حساب بالفعل ؟  <a href="{{ makeRoute("login") }}">تسجيل الدخول </a>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Shop Area  -->

</main>

@endsection
