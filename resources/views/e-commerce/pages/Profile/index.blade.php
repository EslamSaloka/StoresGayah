@extends('e-commerce.layouts.master')
@section('title')
    حسابي
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
                            <li class="axil-breadcrumb-item active" aria-current="page">حسابي</li>
                        </ul>
                        <h1 class="title">إدارة الحساب</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start My Account Area  -->
    <div class="axil-dashboard-area axil-section-gap">
        <div class="container">
            <div class="axil-dashboard-warp">
                <div class="axil-dashboard-author">
                    <div class="media">
                        <div class="thumbnail">
                            <img src="{{ \Auth::user()->display_image }}" alt="{{ \Auth::user()->name }}" width="75px">
                        </div>
                        <div class="media-body">
                            <h5 class="title mb-0">مرحبا {{ \Auth::user()->name }}</h5>
                            <span class="joining-date">عميل منذ  {{ \Auth::user()->created_at->format("d/m/Y") }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <aside class="axil-dashboard-aside">
                            <nav class="axil-dashboard-nav">
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-item nav-link active" data-bs-toggle="tab" href="#nav-account" role="tab" aria-selected="false"><i class="fas fa-user"></i>الملف الشخصي</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-password" role="tab" aria-selected="false"><i class="fas fa-lock"></i>تغيير كلمة المرور</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-orders" role="tab" aria-selected="false"><i class="fas fa-shopping-basket"></i>طلباتي</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-notifications" role="tab" aria-selected="false"><i class="fas fa-bell"></i>الاشعارات</a>
                                    <a class="nav-item nav-link" data-bs-toggle="tab" href="#nav-address" role="tab" aria-selected="false"><i class="fas fa-home"></i>عنوايني</a>
                                    <a class="nav-item nav-link" href="{{ makeRoute('profile.logout') }}"><i class="fal fa-sign-out"></i>تسجيل الخروج</a>
                                </div>
                            </nav>
                        </aside>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="tab-content">
                            <div class="tab-pane fade" id="nav-orders" role="tabpanel">
                                @include('e-commerce.pages.Profile.Data.orders')
                            </div>
                            <div class="tab-pane fade" id="nav-notifications" role="tabpanel">
                                @include('e-commerce.pages.Profile.Data.notifications')
                            </div>
                            <div class="tab-pane fade" id="nav-address" role="tabpanel">
                                @include('e-commerce.pages.Profile.Data.address')
                            </div>
                            <div class="tab-pane fade show active" id="nav-account" role="tabpanel">
                                @include('e-commerce.pages.Profile.Data.profile')
                            </div>
                            <div class="tab-pane fade" id="nav-password" role="tabpanel">
                                @include('e-commerce.pages.Profile.Data.change-password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account Area  -->

    <div class="row" style="height:100px;"></div>

</main>


@endsection
