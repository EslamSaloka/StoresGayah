@extends('website.layouts.master')
@section('title')

@endsection
@section('PageContent')

<main class="main">

    <div class="site-breadcrumb" style="background: url(assets/website/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">اعرف اكثر عن غاية اكسبريس</h2>
            <ul class="breadcrumb-menu">
                <li class="active">من نحن</li>
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
            </ul>
        </div>
    </div>


    <div class="about-area py-120 ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-left">
                        <div class="about-img">
                            <img class="about-img-1" src="assets/website/img/about/01.png" alt="غاية اكسبريس">
                            <img class="about-img-2" src="assets/website/img/about/02.png" alt="غاية اكسبريس">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-right">
                        <div class="site-header">
                            <span class="site-title-tagline">من نحن</span>
                            <h2 class="site-title">نحن هنا في غاية اكسبريس لخدمتك</h2>
                        </div>
                        <p class="about-text">
                            غاية اكسبريس هي مؤسسة سعودية رسمية مسجلة بوزارة التجارة تحت اسم مؤسسة غاية الزبيدي للتجارة.
                            <br>
                            رقم السجل التجاري : 4603151480
                            <br>
                            نحن نقدم خدماتنا في مجال الشحن والتوصيل والخدمات اللوجيستية داخل جميع مدن وأحياء المملكة بالتعاون مع شركات عملاقة مثل سمسا وارامكس.
                            <br>
                            نعمل دائما على تطوير وتحسين خدماتنا المقدمة لجميع عملائنا عبر منصتنا الالكترونية لضمان توفير اعلى معدلات الرضاء لهم.
                            <br>
                            نسعى دائما بفضل عملائنا المخلصين ان نكون من اوئل المؤسسات الرائدة في هذا المجال.
                        </p>
                        <div class="about-list-wrapper">
                            <ul class="about-list list-unstyled">
                                <li>
                                    <div class="icon"><span class="far fa-check-circle"></span></div>
                                    <div class="text">
                                        <p>نقدم حلول ذكية لشحن وإدارة شحناتك بأفضل الأسعار</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon"><span class="far fa-check-circle"></span></div>
                                    <div class="text">
                                        <p>التعاون مع شركات شحن ذات مستويات خدمة عالية جدا</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="testimonial-area testimonial-bg py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">آراء عملائنا</span>
                        <h2 class="site-title text-white">ماذا قالوا عن منصة غاية اكسبريس</h2>
                        <p class="text-white">
                            نسعى دائما لكسب رضاء عملائنا واستقبال ارائهم وانتقاداتهم بصدر رحب
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">


                <div class="testimonial-single">
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="icon-quote"></i></span>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="direction:rtl;">
                            الآن بعدد ماتعرفت عليه وتوقعته صعب مع ضغط شغلي الا انه صار اسسههههل بكثيييييير ويجننننن😍❤️❤️
                        </p>
                    </div>
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Amnai</h4>
                            <p>عميلة</p>
                        </div>
                    </div>
                </div>


                <div class="testimonial-single">
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="icon-quote"></i></span>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="direction:rtl;">
                            الموقع مررره رهيب وسلس ابدعتي
                        </p>
                    </div>
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Reem</h4>
                            <p>عميلة</p>
                        </div>
                    </div>
                </div>


                <div class="testimonial-single">
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="icon-quote"></i></span>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="direction:rtl;">
                            حابة اشكرك على الموقع الأكثر من رائع ممتاز وخدمه اكثر من رائعه
                            <br>
                            امس كانت أول تجربه ناجحه مع الموقع 👍
                        </p>
                    </div>
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Sama</h4>
                            <p>عميلة</p>
                        </div>
                    </div>
                </div>


                <div class="testimonial-single">
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="icon-quote"></i></span>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="direction:rtl;">
                            موقع ممتاز واحلى ميزه الدفع الالكتروني
                        </p>
                    </div>
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Osamma</h4>
                            <p>عميل</p>
                        </div>
                    </div>
                </div>


                <div class="testimonial-single">
                    <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="icon-quote"></i></span>
                        <div class="testimonial-rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="direction:rtl;">
                            موقع مميز تطور ملحوظ سرعه الموقع ماشالله اهنيكي
                        </p>
                    </div>
                    <div class="testimonial-content">

                        <div class="testimonial-author-info">
                            <h4>Fatmah</h4>
                            <p>عميلة</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="partner-area bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline">شركائنا</span>
                        <h2 class="site-title">شركاء النجاح</h2>
                        <p>
                            في غاية اكسبريس نفخر ونعتز بالتعاون والعمل مع شركات شحن عملاقة تعمل داخل المملكة العربية السعودية
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider owl-carousel owl-theme">


                    <div class="col-lg-12 col-md-6" style="padding:10px;">
                        <img src="assets/website/img/partner/1.png" style="background-color:#fff;padding:10px;border-radius:15px;" alt="غاية اكسبريس | شركة سمسا ">
                    </div>

                    <div class="col-lg-12 col-md-6" style="padding:10px;">
                        <img src="assets/website/img/partner/2.png" style="background-color:#fff;padding:10px;border-radius:15px;" alt="غاية اكسبريس | شركة ارامكس">
                    </div>



            </div>
        </div>
    </div>

</main>

@endsection
