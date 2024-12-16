
@if (Route::is("e-commerce.home"))

    <header class="header axil-header header-style-2">
        <!-- Start Header Top Area  -->
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-sm-3 col-5">
                        <div class="header-brand">
                            <a href="{{ makeRoute("home") }}" class="logo logo-dark">
                                <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" class="home_logo" alt="Site Logo">
                            </a>
                            <a href="{{ makeRoute("home") }}" class="logo logo-light">
                                <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" class="home_logo" alt="Site Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-sm-9 col-7">
                        <div class="header-top-dropdown dropdown-box-style">
                            <div class="axil-search">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="far fa-search"></i>
                                </button>
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="ماذا تبحث عن ؟" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top Area  -->


            <!-- Start Mainmenu Area  -->
            <div class="axil-mainmenu aside-category-menu">
                <div class="container">
                    <div class="header-navbar">
                        <div class="header-nav-department">
                            <aside class="header-department">
                                <button class="header-department-text department-title">
                                    <span class="icon"><i class="fal fa-bars"></i></span>
                                    <span class="text">اقسام المتجر</span>
                                </button>
                                <nav class="department-nav-menu">
                                    <button class="sidebar-close"><i class="fas fa-times"></i></button>
                                    <ul class="nav-menu-list">

                                        @foreach (getParentOfCategories() as $category)

                                            @if ($category->children()->count() == 0)
                                                <li>
                                                    <a href="{{ makeRoute('products.index',["category_id"=>$category->id]) }}" class="nav-link">
                                                        <span class="menu-icon">
                                                            <img src="{{ $category->display_image }}" alt="{{ $category->name }}">
                                                        </span>
                                                        <span class="menu-text">
                                                            {{ $category->name }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ makeRoute('products.index',["category_id"=>$category->id]) }}" class="nav-link has-megamenu">
                                                        <span class="menu-icon">
                                                            <img src="{{ $category->display_image }}" alt="{{ $category->name }}">
                                                        </span>
                                                        <span class="menu-text">
                                                            {{ $category->name }}
                                                        </span>
                                                    </a>
                                                    <div class="department-megamenu">
                                                        <div class="department-megamenu-wrap">
                                                            <div class="department-submenu-wrap">
                                                                <div class="department-submenu" style="width:auto !important;">
                                                                    <ul>
                                                                        @foreach ($category->children()->get() as $cat)
                                                                            <li><a href="{{ makeRoute("products.index",["category_id"=>$category->id,"sub_id"=>$cat->id]) }}">{{$cat->name}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                        @endforeach

                                    </ul>
                                </nav>
                            </aside>
                        </div>
                        <div class="header-main-nav">
                            <!-- Start Mainmanu Nav -->
                            <nav class="mainmenu-nav">
                                <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                                <div class="mobile-nav-brand">
                                    <a href="{{ makeRoute('home') }}" class="logo">
                                        <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" alt="Site Logo">
                                    </a>
                                </div>
                                <ul class="mainmenu">
                                    <li><a href="{{ makeRoute('home') }}" @if(Route::is("e-commerce.home")) class="active" @endif>الصفحة الرئيسية</a></li>
                                    <li><a href="{{ makeRoute('products.index') }}" @if(Route::is("e-commerce.products.index")) class="active" @endif>المنتجات</a></li>
                                    @if (\Auth::check())
                                        <li><a href="{{ makeRoute('profile.index') }}" @if(Route::is("e-commerce.profile.index")) class="active" @endif>حسابي</a></li>
                                    @endif
                                    <li><a href="{{ makeRoute('contact.index') }}" @if(Route::is("e-commerce.contact.index")) class="active" @endif>تواصل معنا</a></li>
                                    <li><a href="{{ makeRoute('about') }}" @if(Route::is("e-commerce.about")) class="active" @endif>عن المتجر</a></li>
                                    @if (!\Auth::check())
                                        <li><a href="{{ makeRoute('login') }}" @if(Route::is("e-commerce.login")) class="active" @endif>تسجيل دخول</a></li>
                                    @endif
                                </ul>
                            </nav>
                            <!-- End Mainmanu Nav -->
                        </div>
                        <div class="header-action">
                            <ul class="action-list">
                                <li class="axil-search d-sm-none d-block">
                                    <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                        <i class="flaticon-magnifying-glass"></i>
                                    </a>
                                </li>
                                <li class="wishlist">
                                    <a href="{{ makeRoute('favorites.index') }}">
                                        <i class="flaticon-heart"></i>
                                    </a>
                                </li>
                                <li class="shopping-cart">
                                    <a href="#" class="cart-dropdown-btn">
                                        <span class="cart-count cartCount">{{ (new \App\Support\Cart)->getCount() }}</span>
                                        <i class="flaticon-shopping-cart"></i>
                                    </a>
                                </li>

                                <li class="axil-mobile-toggle">
                                    <button class="menu-btn mobile-nav-toggler">
                                        <i class="flaticon-menu-2"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Mainmenu Area  -->

    </header>

@else


    <header class="header axil-header header-style-5">

        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="{{ makeRoute("home") }}" class="logo logo-dark">
                            <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" class="home_logo" alt="Site Logo">
                        </a>
                        <a href="{{ makeRoute("home") }}" class="logo logo-light">
                            <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" class="home_logo" alt="Site Logo">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="{{ makeRoute("home") }}" class="logo">
                                    <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" alt="Site Logo">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li><a href="{{ makeRoute('home') }}" @if(Route::is("e-commerce.home")) class="active" @endif>الصفحة الرئيسية</a></li>
                                    <li><a href="{{ makeRoute('products.index') }}" @if(Route::is("e-commerce.products.index")) class="active" @endif>المنتجات</a></li>
                                    @if (\Auth::check())
                                        <li><a href="{{ makeRoute('profile.index') }}" @if(Route::is("e-commerce.profile.index")) class="active" @endif>حسابي</a></li>
                                    @endif
                                    <li><a href="{{ makeRoute('contact.index') }}" @if(Route::is("e-commerce.contact.index")) class="active" @endif>تواصل معنا</a></li>
                                    <li><a href="{{ makeRoute('about') }}" @if(Route::is("e-commerce.about")) class="active" @endif>عن المتجر</a></li>
                                    @if (!\Auth::check())
                                        <li><a href="{{ makeRoute('login') }}" @if(Route::is("e-commerce.login")) class="active" @endif>تسجيل دخول</a></li>
                                    @endif
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search d-xl-block d-none">
                                <input type="search" class="placeholder product-search-input" name="search2" id="search2" value="" maxlength="128" placeholder="ماذا تبحث عن ؟ " autocomplete="off">
                                <button type="submit" class="icon wooc-btn-search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </button>
                            </li>
                            <li class="axil-search d-xl-none d-block">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="wishlist">
                                <a href="{{ makeRoute('favorites.index') }}">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li>
                            <li class="shopping-cart">
                                <a href="cart.php" class="cart-dropdown-btn">
                                    <span class="cart-count cartCount">{{ (new \App\Support\Cart)->getCount() }}</span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>

                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>

@endif



<a href="https://api.whatsapp.com/send/?phone={{ getStoreInformation("whatsapp") }}&text=Hello&type=phone_number&app_absent=0" class="float">
    <i style="font-size:30px;" class="fab fa-whatsapp my-float"></i>
</a>
