<header class="home-2 header">
    <div class="main-navigation">
        <nav class="navbar navbar-expand-lg" style="direction:rtl;">
            <div class="container g-0">

                <a class="navbar-brand" href="{{ route('website.home') }}">
                    <img src="assets/website/img/logo/logo.png" alt="thumb">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fal fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('website.home') }}">الرئيسية</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('website.about-us') }}">من نحن</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('website.contact-us') }}">تواصل معنا</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('website.faqs') }}">الاسئلة الشائعة</a>
                        </li>

                    </ul>

                    <div class="header-btn">
                        <a href="https://app.gayah-express.com/dashboard/login?store=1" class="theme-btn">للتسجيل مجانا <span class="far fa-sign-in"></span></a>
                    </div>

                </div>
            </div>
        </nav>
    </div>
</header>
