@extends('website.layouts.master')
@section('title')

@endsection
@section('PageContent')


<main class="main">

    <div class="site-breadcrumb" style="background: url(assets/website/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">الاسئلة الشائعة</h2>
            <ul class="breadcrumb-menu">
                <li class="active">الأسئلة الشائعة</li>
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
            </ul>
        </div>
    </div>


    <div class="faq-area py-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="site-heading text-center">
                        <span class="site-title-tagline"></span>
                        <h2 class="site-title">أهم الاسئلة الشائعة</h2>
                        <p>
                            تسهيلا على عملائنا الكرام قمنا بجمع وحصر معظم الاسئلة المتكررة وقمنا بالاجابة عليها توفيرا لوقتكم الكريم
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <i class="far fa-question"></i>
                                    ماهي غاية اكسبرس ؟
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    هي شركة تربط شركات الشحن بالتجار والشركات والمؤسسات عن طريق توفير بوليصات الشحن بأسعار منافسة ومميزات حصرية
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                    <i class="far fa-question"></i>
                                    هل يلزم اشتراك؟
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    لا يلزم أي اشتراك فقط مجرد التسجيل بالموقع الالكتروني يعتبر اشتراك
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                    <i class="far fa-question"></i>
                                    هل شركات الشحن توصل للبيت ؟
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    نعم اذا كان في الفرع مندوب توصيل
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    <i class="far fa-question"></i>
                                    ماهي اسعار شركات الشحن ؟
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    الأسعار تختلف من شركة لأخرى ولكن يمكنك الاطلاع عليها من خلال الموقع والدخول الى خدمات الشحن ومعرفة كافة الأسعار
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                    <i class="far fa-question"></i>
                                    هل هناك مندوب يقوم باستلام الشحنات ؟
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    كل شركة شحن لها نظام للمناديب
                                    ارامكس و سمسا 5 شحنات من خلال التواصل مع الدعم الفني لرفع طلب مندوب
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                    <i class="far fa-question"></i>
                                    هل توفرون أكياس وكراتين ؟
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    يتم توفير أكياس فقط وتكون عن طريق الحجز بالايميل او الاتصال على خدمة العملاء
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                    <i class="far fa-question"></i>
                                    كم أسعار الرجيع ؟
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    سمسا 5 ريال للشحنة - ارامكس مجاني
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                    <i class="far fa-question"></i>
                                    بالنسبة للكسر والتلف ؟
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    شركات الشحن تعوض التالف
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                    <i class="far fa-question"></i>
                                    كم مدة توصيل الشحنات ؟
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    غالبا تأخذ من 2-5 أيام وقد تطول قليلا حسب المدن والقرى
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                    <i class="far fa-question"></i>
                                    عند التسجيل يظهر خطأ في كلمة السر ؟
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    كلمة السر لابد أن تكون بالإنجليزية تحتوي على حرف كبير وصغير وأرقام ورموز (!@#$%^&*)
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading11">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                    <i class="far fa-question"></i>
                                    اسم الشركة ماذا يعني ؟
                                </button>
                            </h2>
                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    اسم الشركة او اسم المتجر في حالة الشركات او المؤسسات او المتاجر الالكترونية اما الافراد يسجل باسمه مباشرة
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
