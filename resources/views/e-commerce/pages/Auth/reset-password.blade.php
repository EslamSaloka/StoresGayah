@extends('e-commerce.layouts.master')
@section('title')
    إعادة تعيين كلمة المرور
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
                            <li class="axil-breadcrumb-item active" aria-current="page">إعادة تعيين كلمة المرور</li>
                        </ul>
                        <h1 class="title">إعادة تعيين كلمة المرور
                        </h1>
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
                            <p class="b2 mb--55">اكتب كلمة المرور الجديدة لحسابك</p>
                            <form class="singin-form SendDataForm" action="{{ makeRoute('reset-password.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>كود التحقق</label>
                                    <input type="text" class="form-control inputD" name="otp" placeholder="****" min="4" max="4">
                                </div>
                                <div class="form-group">
                                    <label>كلمة المرور الجديدة</label>
                                    <input type="password" class="form-control inputD" name="password" placeholder="********">
                                </div>
                                <div class="form-group">
                                    <label>تأكيد كلمة المرور</label>
                                    <input type="password" class="form-control inputD" name="password_confirmation" placeholder="********">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="axil-btn btn-bg-primary submit-btn" style="width:100%;">تنفيذ</button>
                                </div>
                            </form>

                            <form action="{{ makeRoute('re-send') }}" method="post">
                                <div class=" form-group">
                                    <div class="">
                                        @csrf
                                        <button class="axil-btn btn-bg-info submit-btn" type="submit" disabled id='resend_btn'>إعادة ارسال رمز التحقق  <i id='countdown'></i></button>
                                    </div>
                                    <div class="col-md-4 col-sm-4" style="float:left;margin-top:8px;" id='countdown'></div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="background-color: #f6f7fb;height:2px;margin-top:100px;"></div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Shop Area  -->

</main>


@endsection
@push('scripts')

@if (Session::get('success'))
    <script>
        Swal.fire({
            title: 'عملية ناجحة',
            text: "{{ Session::get('success') }}",
            icon: 'success',
            confirmButtonText: 'موافق'
        })
    </script>
@endif
@if (Session::get('danger'))
    <script>
        Swal.fire({
            title: 'حدث خطأ',
            text: "{{ Session::get('danger') }}",
            icon: 'error',
            confirmButtonText: 'موافق'
        })
    </script>
@endif

    <script>
        function countdown( elementName, minutes, seconds ) {
            var element, endTime, hours, mins, msLeft, time;
            function twoDigits(n)
            {
                return (n <= 9 ? "0" + n : n);
            }
            function updateTimer()
            {
                msLeft = endTime - (+new Date);
                if ( msLeft < 1000 ) {
                    element.innerHTML='';
                    $('#resend_btn').removeAttr('disabled');
                } else {
                    time = new Date( msLeft );
                    hours = time.getUTCHours();
                    mins = time.getUTCMinutes();
                    element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
                    setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
                }
            }
            element = document.getElementById( elementName );
            endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
            updateTimer();
        }
        countdown( "countdown", 1, 0 );
    </script>
@endpush
