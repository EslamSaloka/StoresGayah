@extends('e-commerce.layouts.master')
@section('title')
    عن المتجر
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
                            <li class="axil-breadcrumb-item active" aria-current="page">عن المتجر</li>
                        </ul>
                        <h1 class="title">عن المتجر</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start About Area  -->
    <div class="axil-about-area about-style-1 axil-section-gap ">
        <div class="container">
            <div class="row ">
                <div class="col-xl-3 col-lg-4">
                    <div class="about-thumbnail">
                        <div class="thumbnail">
                            <img src="{{ getAboutPage()->display_image ?? '' }}" alt="About Us">
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6">
                    <div class="about-content content-right">
                        <h3 class="title">متجر {{ getStoreInformation("store_name") }}</h3>

                        <div class="row">
                            <div class="col-xl-12">
                                <p style="line-height:2;font-size:16px;">
                                    {!! nl2br(getAboutPage()->content ?? '') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End About Area  -->


</main>


@endsection
