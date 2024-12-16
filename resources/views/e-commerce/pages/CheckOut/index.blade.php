@extends('e-commerce.layouts.master')
@section('title')
    إستكمال الطلب
@endsection
@section('PageContent')
@php
    $cart = (new \App\Support\Cart);
@endphp

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
                            <li class="axil-breadcrumb-item"><a href="{{ makeRoute('cart.index') }}">سلة الشراء</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active" aria-current="page">اتمام الطلب</li>
                        </ul>
                        <h1 class="title">إتمام الطلبية</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->

    <!-- Start Checkout Area  -->
    <div class="axil-checkout-area axil-section-gap">
        <div class="container">

                <div class="row">
                    <h4>اختر عنوان الشحن</h4>
                    @php
                        $address = \App\Models\User\Address::Tenancy()->get();
                    @endphp
                    <div class="col-lg-6">
                        @if ($address->count() > 0)
                            <div class="form-group">
                                <label>عنوان الشحن <span></span></label>
                                <select id="aap">
                                    <option value="">
                                        إختر العنوان
                                    </option>
                                    @foreach ($address as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="axil-checkout-billing">


                            <div class="form-group different-shippng">
                                <div class="toggle-bar @if ($address->count() == 0) active @endif">
                                    <a href="javascript:void(0)" class="toggle-btn">
                                        <input type="checkbox" id="checkbox2" @if ($address->count() == 0) checked @endif>
                                        <label for="checkbox2">اضافة عنوان شحن جديد</label>
                                    </a>
                                </div>
                                @php
                                    if($cart->shippingBy() == "aramex") {
                                        $cities = (new \App\Shipping\Aramex)->getCities();
                                    } elseif($cart->shippingBy() == "spol") {
                                        $cities = (new \App\Shipping\Spol())->getCities();
                                    } else {
                                        $cities = (new \App\Shipping\Smsa())->getCities();
                                    }
                                @endphp
                                    <div class="toggle-open" @if ($address->count() == 0) style="display: block;" @endif>
                                        <form action="{{ makeRoute('address.store') }}" method="post" class="SendDataForm">
                                            <div class="form-group">
                                                <label>اختر المدينة <span>*</span></label>
                                                <select id="Region" name="city" class="inputD select2">
                                                    @foreach ($cities as $k=>$list)
                                                        @if (\App::getLocale() == "ar")
                                                            <option value="{{$k}}" @if($k == old("city"))selected @endif>{{$list}}</option>
                                                        @else
                                                            <option value="{{$k}}" @if($k == old("city"))selected @endif>{{$k}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>إسم العنوان<span>*</span></label>
                                                <input type="text" name="title" class="mb--15 inputD" placeholder="">
                                                <input type="hidden" name="shipping_by" value="{{ $cart->shippingBy() }}" class="inputD">
                                            </div>
                                            <div class="form-group">
                                                <label>العنوان<span>*</span></label>
                                                <input type="text" name="address" id="address1" class="mb--15 inputD" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>الرمز البريدي<span>*</span></label>
                                                <input type="text" id="town" class="inputD" name="postcode">
                                            </div>
                                            <div class="form-group">
                                                <label>رقم الدور - رقم الشقة</label>
                                                <input type="text" id="country" class="inputD" name="phone">
                                            </div>
                                            @csrf
                                            <button type="submit" class="axil-btn btn-bg-primary checkout-btn">حفظ العنوان</button>
                                        </form>
                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ makeRoute('check-out.store') }}" class="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="axil-order-summery order-checkout-summery">
                                <input type="hidden" name="address_id" class="inputD" id="address_id">

                                <div class="order-payment-method">
                                    <h5 class="title mb--20">اختر طريقة الدفع : </h5>

                                    @php
                                        $selectPaymentsTypes = json_decode(getStoreInformation("payments"),true);
                                    @endphp

                                    @if (in_array("bank",$selectPaymentsTypes))
                                        @php
                                            $banks = \App\Models\Bank::Tenancy()->get();
                                        @endphp
                                        @if ($banks->count() > 0)
                                            <div class="single-payment">
                                                <div class="input-group  toggle-ba different-shippng">
                                                    <a href="javascript:void(0)" class="toggle-btn">
                                                        <input type="radio" id="radio4" value="bank" name="payment_type" class="inputD">
                                                        <label for="radio4">تحويل بنكي</label>
                                                    </a>
                                                    <p style="margin-top:5px;">قم بالتحويل على حسابنا البنكي. يرجى إرفاق صوةر إيصال التحويل الخاص بك كمرجع للدفع. لن يتم شحن طلبك حتى يتم تاكيد الأموال في حسابنا.</p>

                                                    <div class="toggle-open" id="PaymentTypeBank" style="display: none">
                                                        <h6 class="title">بيانات الحساب البنكي</h6>
                                                        @foreach ($banks as $bank)
                                                        <table class="table table-responsive table-hover justify-content-between align-items-center">
                                                            <tr>
                                                                <td>البنك : </td>
                                                                <td>{{ $bank->bank_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>اسم صاحب الحساب : </td>
                                                                <td>{{ $bank->account_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>رقم الحساب : </td>
                                                                <td>{{ $bank->account_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>رقم الايبان : </td>
                                                                <td>{{ $bank->iban }}</td>
                                                            </tr>
                                                        </table>
                                                            <div style="background:#fff;height:2px;margin-bottom:15px;"></div>
                                                        @endforeach

                                                        <h4 style="font-size:15px;color:#000;">ارفق صورة ايصال التحويل</h4>
                                                        <div class="form-group">
                                                            <input type="file" name="image" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    @if (in_array("cod",$selectPaymentsTypes))
                                        <div class="single-payment">
                                            <div class="input-group">
                                                <input type="radio" id="radio5" value="cod" name="payment_type" class="inputD">
                                                <label for="radio5">دفع عند الإستلام</label>
                                            </div>
                                            <p style=" margin-bottom: 10px; ">يتم سداد قيمة الطلب كاملا عند استلامك للطلب من مندوب الشحن</p>
                                            <span id="cod_fees_text" style="display: none;color:{{getStoreInformation('main_color')}}">
                                                سوف يتم إضافة مبلغ 10 ريال رسوم الدفع عند الإستلام يضاف علي المبلغ الإجمالي للطلب
                                            </span>
                                        </div>
                                    @endif
                                    @if (in_array("visa",$selectPaymentsTypes))
                                        <div class="single-payment">
                                            <div class="input-group justify-content-between align-items-center">
                                                <input type="radio" id="radio6" name="payment_type" class="inputD" value="visa" checked>
                                                <label for="radio6">دفع الكتروني مباشر</label>
                                            </div>
                                            <p>نقبل الدفع بوسائل الدفع الالكترونية</p>
                                        </div>
                                    @endif

                                </div>


                                <h5 class="title mb--20">ملخص الطلب</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table">
                                        <thead>
                                        <tr>
                                            <th>المنتج</th>
                                            <th>المجموع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($cart->showItems() as $item)
                                            <tr class="order-product">
                                                <td><span class="quantity"> x{{$item['qty']}} </span>{{$item['name']}}</td>
                                                <td>{{$item['total']}} ر.س</td>
                                            </tr>
                                        @endforeach
                                        <tr class="order-subtotal">
                                            <td>المجموع الفرعي</td>
                                            <td id="cartSubPrice" data-price="{{ $cart->getSubTotal() }}">{{ $cart->getSubTotal() }} ر.س</td>
                                        </tr>
                                        <tr class="order-shipping">
                                            <td colspan="2">
                                                <div class="shipping-amount">
                                                    <span class="title">رسوم الشحن</span>
                                                    <span class="amount" data-price="{{ $cart->getShippingPrice() }}" id="cartShippingPrice">{{ ($cart->getShippingPrice() == 0) ? 'شحن مجاني' : $cart->getShippingPrice().' ر.س' }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="order-shipping cod_fees_div" style="display: none">
                                            <td colspan="2">
                                                <div class="shipping-amount">
                                                    <span class="title">قيمة التوصيل عند الإستلام</span>
                                                    <span class="amount" data-price="0" id="cartCodPrice">0 ر.س</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="order-shipping" @if ($cart->getCouponPrice() == 0)
                                            style="display:none"
                                        @endif>
                                            <td colspan="2">
                                                <div class="shipping-amount">
                                                    <span class="title">قيمة الخصم</span>
                                                    <span class="amount" style="color: red" data-price="{{ $cart->getCouponPrice() }}" id="cartCouponPrice">{{ $cart->getCouponPrice() }} ر.س</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="order-shipping" @if ($cart->getVatPrice() == 0)
                                            style="display:none"
                                        @endif>
                                            <td colspan="2">
                                                <div class="shipping-amount">
                                                    <span class="title">قيمة الضريبة المضافة</span>
                                                    <span class="amount" data-price="{{ $cart->getVatPrice() }}" id="cartVatPrice">{{ $cart->getVatPrice() }} ر.س</span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <td>الأجمالي الكلي</td>
                                            <td class="order-total-amount" id="cartTotal">{{ $cart->getTotal() }} ر.س</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit" class="axil-btn btn-bg-primary checkout-btn">تنفيذ الطلب</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    <!-- End Checkout Area  -->

</main>

@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-hidden-accessible {
            width: 100% !important;
        }
        .select2-container{
            width: 100% !important;
        }
        .select2-container--default .select2-selection--single {
            border: none !important;
            margin-top: 12px;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".select2").select2({
            dir: "rtl"
        });
    </script>

    <script>
        $("#aap").change(function(){
            $('#address_id').val($(this).val());
        });
        $("input[name=payment_type]").click(function(){
            var sub      = parseFloat($("#cartSubPrice").data("price"));
            var coupon   = parseFloat($("#cartCouponPrice").data("price"));
            var shipping = parseFloat($("#cartShippingPrice").data("price"));
            var cod      = 0;
            var vat      = parseFloat($("#cartVatPrice").data("price"));
            var total    = 0;
            if($(this).val() == "cod") {
                $("#cod_fees_text").css("display","block");
                $(".cod_fees_div").css("display","contents");
                $("#PaymentTypeBank").css("display","none");
                $("#cartCodPrice").html("10 ر.س")
                cod    = parseFloat(10);
                total  = (sub - coupon) + cod + vat + shipping;
            } else if($(this).val() == "bank") {
                $("#cod_fees_text").css("display","none");
                $(".cod_fees_div").css("display","none");
                $("#PaymentTypeBank").css("display","block");
                $("#cartCodPrice").html("0 ر.س")
                cod    = parseFloat(0);
                total  = (sub - coupon) + vat + shipping;
            } else {
                $("#cod_fees_text").css("display","none");
                $(".cod_fees_div").css("display","none");
                $("#PaymentTypeBank").css("display","none");
                $("#cartCodPrice").html("0 ر.س")
                cod    = parseFloat(0);
                total  = (sub - coupon) + vat + shipping;
            }
            $("#cartTotal").html(parseFloat(total)+" ر.س");
        });

    </script>
@endpush
