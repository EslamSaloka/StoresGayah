@extends('website.layouts.master')
@section('title')

@endsection
@section('PageContent')


<main class="main">

    <div class="site-breadcrumb" style="background: url(assets/website/img/breadcrumb/01.jpg)">
        <div class="container">
            <h2 class="breadcrumb-title">تواصل معنا</h2>
            <ul class="breadcrumb-menu">
                <li class="active">تواصل معنا</li>
                <li><a href="{{ route('website.home') }}">الرئيسية</a></li>
            </ul>
        </div>
    </div>


    <?php
    if(isset($_GET['send_success'])){ ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(window).load(function(){
                $('#myModal').modal('show');
            });
        </script>

        <div onclick="location.href='contact-us.php'" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:30%;">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#ee7739;display: initial;">
                        <h5 class="modal-title" style="color:#fff;text-align:center;font-size:20px;">تنبيه</h5>
                    </div>
                    <div class="modal-body" style="background-color:#fff;color:#000;">
                        <p style="text-align:center;font-size:17px;">تم استلام رسالتك بنجاح ، سيتم الرد عليك في اسرع وقت</p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <div class="contact-area py-120">
        <div class="container">
            <div class="contact-content">
                <div class="row">

                    <div class="col-md-6 col-lg-4">
                        <div class="contact-info">
                            <i class="fal fa-phone"></i>
                            <h5>رقم الجوال</h5>
                            <p>00966501932466</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="contact-info">
                            <i class="fal fa-envelope"></i>
                            <h5>البريد الالكتروني</h5>
                            <p>gayaheexpress@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="contact-info">
                            <i class="fal fa-clock"></i>
                            <h5>مواعيد العمل</h5>
                            <p>الأحد - الخميس (٨ ص : ٥ م)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-md-12 align-self-center">
                        <div class="contact-form">
                            <div class="contact-form-header">
                                <h2>كن على تواصل معنا</h2>
                                <p>نسعد باتصالاتكم واستفساراتكم على مدار الساعة</p>
                            </div>
                            <form method="post" action="smtp.php">
                                <div class="row" style="direction:rtl;">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="الاسم" required>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" minlength="10" maxlength="13" class="form-control" name="phone" placeholder="رقم الجوال" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="موضوع الرسالة" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="comment" cols="30" rows="5" class="form-control" placeholder="اكتب رسالتك او اقتراحك هنا"></textarea>
                                </div>
                                <button type="submit" name="send" class="contact-btn"> <i class="far fa-paper-plane"></i> ارسال</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
