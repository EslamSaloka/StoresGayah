@extends('e-commerce.layouts.master')
@section('title')
    عرض الطلب
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
                            <li class="axil-breadcrumb-item active" aria-current="page">تفاصيل الطلب</li>
                        </ul>
                        <h1 class="title">طلب رقم {{ $order->id }}</h1>
                        <div class="alert" style="text-align:left;width:30%;">
                            <input type="button" class="btn btn-lg btn-outline-primary print_btn" style="padding:5px;" onclick="printDiv('printableArea')" value="طباعة الفاتورة" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->


    <div class="axil-product-cart-area axil-section-gap" id="printableArea" style="padding:40px 0 100px 0px;">
        <div class="container">


            <div class="axil-product-cart-wrap">

                <div style="width:100%;text-align:center;" class="onlyPrint" >
                    <img src="{{env('APP_SYSTEM_URL')}}/{{ getStoreInformation("logo") }}" style="text-align:center;width:150px;height:auto;margin:20px 0px;">
                    <h4>متجر {{ getStoreInformation("store_name") }}</h4>
                    <div style="background:rgba(204,204,204,0.45);height:2px;margin:10px 0;"></div>
                </div>


                <div class="row">

                    <div class="col-lg-8">

                        @if ($order->status == "new")
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>حالة الطلب : قيد المراجعة</strong>
                            </div>
                        @elseif($order->status == "reject")
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>حالة الطلب : طلب مرفوض</strong>
                            </div>
                        @else
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>حالة الطلب : تم تأكيد الطلب</strong>
                            </div>
                        @endif


                        <h5 class="onlyPrint" style="margin-top:40px;">رقم الطلب : {{ $order->id }}</h5>

                        <div class="alert" style="border:none;background:#e2e3e570;">
                            <p style="font-size:20px;color:black;">بيانات العميل</p>
                        </div>
                            <div class="axil-order-summery" style="padding:10px 0;background:#fff;">
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                        <tr>
                                            <td>الاسم</td>
                                            <td>
                                                {{ $order->user->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>رقم الجوال</td>
                                            <td>
                                                {{ $order->user->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>البريد الالكتروني</td>
                                            <td>
                                                {{ $order->user->email }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        <div class="alert" style="border:none;background:#e2e3e570;">
                            <p style="font-size:20px;color:black;">بيانات الشحن والتوصيل</p>
                        </div>
                            <div class="axil-order-summery" style="padding:10px 0;background:#fff;">
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                        <tr>
                                            <td>المدينة</td>
                                            <td>
                                                {{ $order->address->city }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>العنوان</td>
                                            <td>
                                                {{ $order->address->address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>الرمز البريدي</td>
                                            <td>
                                                {{ $order->address->postcode }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>رقم الشقة - رقم المبني</td>
                                            <td>
                                                {{ $order->address->phone }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        <div class="onlyPrint" style="height:20px;"></div>
                        <div class="alert" style="border:none;background:#e2e3e570;">
                            <p style="font-size:20px;color:black;">بيانات المنتجات</p>
                        </div>


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th></th>
                                    <th>السعر</th>
                                    <th>الكمية</th>
                                    <th>الاجمالي</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items()->get() as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ $item->product->display_image }}" style="width:50px;height:auto">
                                            </td>
                                            <td>
                                                {{ $item->product->name }}
                                            </td>
                                            <td>{{ $item->price }} ر.س</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->total }} ر.س</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>

                    </div>

                    <div class="col-lg-4">

                        <div class="alert" style="border:none;background:#e2e3e570;">
                            <p style="font-size:20px;color:black;">تكلفة الطلب</p>
                        </div>
                        <div class="axil-order-summery" style="padding:20px;background:#fff;">
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                    <tr class="order-subtotal">
                                        <td>تكلفة الطلب</td>
                                        <td>  {{ $order->sub_total }} ر.س</td>
                                    </tr>
                                    <tr class="order-shipping">
                                        <td>رسوم الشحن والتوصيل</td>
                                        <td>  {{ $order->shipping_price }} ر.س</td>
                                    </tr>
                                    <tr class="order-tax">
                                        <td>قيمة الخصم</td>
                                        <td style="color: red"> {{ $order->coupon_price }} ر.س</td>
                                    </tr>
                                    @if ($order->cod_fees != 0)
                                    <tr class="order-tax">
                                        <td>تكلفه الدفع عند الإستلام</td>
                                        <td> {{ 10 }} ر.س</td>
                                    </tr>
                                    @endif
                                    <tr class="order-tax">
                                        <td>قيمة الضريبة المضافة</td>
                                        <td> {{ $order->vat_price }} ر.س</td>
                                    </tr>
                                    <tr class="order-total">
                                        <td>الإجمالي</td>
                                        <td class="order-total-amount">{{ $order->total }} ر.س</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>

                        <div class="alert" style="border:none;background:#e2e3e570;">
                            <p style="font-size:20px;color:black;">حالة الطلب وبوليصة الشحن</p>
                        </div>
                        <div class="axil-order-summery" style="padding:20px;background:#fff;">
                            <div class="summery-table-wrap">
                                <table class="table summery-table mb--30">
                                    <tbody>
                                    <tr class="">
                                        <td>شركة الشحن</td>
                                        <td>{{ $order->shipping_by }}</td>
                                    </tr>
                                    <tr class="">
                                        <td>طريقة الدفع</td>
                                        <td>
                                            @if ($order->payment_type == 'visa')
                                                دفع الكتروني
                                            @elseif ($order->payment_type == 'cod')
                                                دفع عند الإستلام
                                            @else
                                                حواله بنكية
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($order->payment_type == "bank")
                                        <tr class="d-print-none">
                                            <td>ايصال التحويل</td>
                                            <td>
                                                <!--<img src="{{ url($order->image) }}" style="width:50px;height:auto">-->
                                                <a class="image-popup-vertical-fit" href="{{ url($order->image) }}">
                                                    <img class="img-fluid" alt="" src="{{ url($order->image) }}"  style="width:100px;height:auto">
                                                </a>
                                            </td>
                                        </tr>
                                    @endif

                                    <tr class="">
                                        <td>حاله السداد</td>
                                        <td>
                                            @if ($order->payment_status == "paid")
                                                <span style="color:green;">تم السداد</span>
                                            @else
                                                <span style="color:red;">لم يتم السداد</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="">
                                        <td>رقم البوليصة</td>
                                        <td>
                                            @if (!is_null($order->tracking_id))
                                                <a target="_blank" href="{{ makeRoute('orders.tracking',[$order->id]) }}">
                                                    {{ $order->tracking_id ?? '-------' }}
                                                </a>
                                            @else
                                                ------
                                            @endif
                                        </tr>
                                    @if (!is_null($order->tracking_id))
                                        <tr class="d-print-none">
                                            <td>
                                                تتبع الطلب
                                            </td>
                                            @if ($order->shipping_by == "aramex")
                                                <td id="loader_{{$order->id}}">
                                                    <a  href="https://www.aramex.com/track/results?ShipmentNumber={{$order->tracking_id}}" target="_blank" class="waves-effect" style="background:#ec681d;color:white !important; padding:5px 10px;border-radius:3px;font-size:13px;">
                                                        تتبع الطلبية من هنا
                                                    </a>
                                                </td>
                                            @elseif($order->shipping_by == "spol")
                                                <td>
                                                    <a  data-id="{{$order->tracking_id}}"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasWithBothOptionsFilter2"
                                                        data-title="@lang('تتبع الشحنة')"
                                                        aria-controls="offcanvasWithBothOptionsFilter2"
                                                        class="waves-effect spolShow" style="background:#ec681d;color:white !important; padding:5px 10px;border-radius:3px;font-size:13px;">
                                                        تتبع الطلبية من هنا
                                                    </a>
                                                </td>
                                            @else
                                                <td id="loader_{{$order->id}}">
                                                    <a  href="https://www.smsaexpress.com/ar/trackingdetails?tracknumbers%5B0%5D={{$order->tracking_id}}" target="_blank" class="waves-effect" style="background:#ec681d;color:white !important; padding:5px 10px;border-radius:3px;font-size:13px;">
                                                        تتبع الطلبية من هنا
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

@endsection
@push('styles')
    <style>
        @media screen {
            .onlyPrint {
                display: none;
            }
        }
    </style>
    <!-- Lightbox css -->
    <link href="{{ url('/assets/website/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
    <script>
        function printDiv(printableArea) {
            var printContents = document.getElementById("printableArea").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
    <!-- Magnific Popup-->
    <script src="{{ url('/assets/website/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- lightbox init js-->
    <script src="{{ url('/assets/website/js/lightbox.init.js') }}"></script>
@endpush
