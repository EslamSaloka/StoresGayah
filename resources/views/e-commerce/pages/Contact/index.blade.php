@extends('e-commerce.layouts.master')
@section('title')
    تواصل معنا
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
                            <li class="axil-breadcrumb-item"><a href="index.php">الرئيسية</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">تواصل معنا</li>
                        </ul>
                        <h1 class="title">تواصل معنا</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Contact Area  -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10 mt--10">نسعد دائما بتلقي اتصالاتكم واستفساراتكم</h3>
                            <p></p>
                            <form id="contact-form" method="POST" action="{{ makeRoute('contact.store') }}" class="SendDataForm">
                                @csrf
                                <div class="row row--10">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-name">الاسم <span>*</span></label>
                                            <input class="inputD" type="text" name="name" id="contact-name" value="{{ (\Auth::check()) ? \Auth::user()->name : null }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-phone">رقم الجوال <span>*</span></label>
                                            <input class="inputD" type="text" name="phone" id="contact-phone" value="{{ (\Auth::check()) ? \Auth::user()->phone : null }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="contact-email">البريد الالكتروني <span>*</span></label>
                                            <input class="inputD" type="email" name="email" id="contact-email" value="{{ (\Auth::check()) ? \Auth::user()->email : null }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-message">رسالتك</label>
                                            <textarea class="inputD" name="message" id="contact-message" cols="1" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--80">
                                            <button name="submit" type="submit" id="submit" class="axil-btn btn-bg-primary">ارســال</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--30 mt--10">بيانات الاتصال</h4>
                            <span class="address mb--20"><i class="fa fa-map" style="margin-left:10px;"></i>{{ getStoreInformation('address') }}</span>
                            <span class="phone mb--20"><i class="fa fa-phone" style="margin-left:10px;"></i>{{ getStoreInformation('phone') }}</span>
                            <span class="email mb--20"><i class="fa fa-envelope" style="margin-left:10px;"></i>{{ getStoreInformation('email') }}</span>
                        </div>

                        <div class="opening-hour">
                            <h4 class="title mb--20">تابعنا على منصات التواصل الاجتماعي : </h4>
                            <div class="social-share">
                                <a href="{{ getStoreInformation('facebook') }}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{ getStoreInformation('instagram') }}"><i class="fab fa-instagram"></i></a>
                                <a href="{{ getStoreInformation('twitter') }}"><i class="fab fa-twitter"></i></a>
                                <a href="{{ getStoreInformation('snapchat') }}"><i class="fab fa-snapchat"></i></a>
                                <a href="{{ getStoreInformation('tiktok') }}"><i class="fa-brands fa-tiktok"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Contact Area  -->
</main>

@endsection
