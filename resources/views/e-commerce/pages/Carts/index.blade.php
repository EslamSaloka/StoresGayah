@extends('e-commerce.layouts.master')
@section('title')
    سله الشراء
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
                            <li class="axil-breadcrumb-item active" aria-current="page">سلة المشتريات</li>
                        </ul>
                        <h1 class="title">سلة المشتريات</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Area  -->
    <!-- Start Cart Area  -->
    <div class="axil-product-cart-area axil-section-gap">
        <div class="container">
            <div class="axil-product-cart-wrap">
                @php
                    $cart = (new \App\Support\Cart);
                @endphp

                @if ($cart->getCount() != 0)
                    <div class="table-responsive">
                        <table class="table axil-product-table axil-cart-table mb--40">
                            <thead>
                            <tr>
                                <th scope="col" class="product-remove"></th>
                                <th scope="col" class="product-thumbnail">الصورة</th>
                                <th scope="col" class="product-title">اسم المنتج</th>
                                <th scope="col" class="product-price">السعر</th>
                                <th scope="col" class="product-quantity">الكمية</th>
                                <th scope="col" class="product-subtotal">الاجمالي</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->showItems() as $item)
                                    <tr class="cart-item" id="cart_{{$item['id']}}">
                                        <td class="product-remove"><button data-url="{{ makeRoute('cart.delete',[$item['id']]) }}" class="remove-wishlist cartDeleteAction" data-id="{{$item['id']}}"><i class="fal fa-times"></i></button></td>
                                        <td class="product-thumbnail"><a href="{{ makeRoute('products.show',[$item['id']]) }}"><img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"></a></td>
                                        <td class="product-title"><a href="{{ makeRoute('products.show',[$item['id']]) }}">{{ $item['name'] }}</a></td>
                                        <td class="product-price" data-title="السعر"><span class="currency-symbol">{{ $item['price'] }} ر.س</span></td>
                                        <td class="product-quantity" data-title="الكمية">
                                            <div class="pro-qty" data-action="{{ makeRoute('cart.addOrRemoveQty',[$item['id']]) }}">
                                                <input readonly type="number" min="1" class="quantity-input" value="{{ $item['qty'] }}">
                                            </div>
                                        </td>
                                        <td class="product-price" data-title="المجموع"><span class="currency-symbol">{{ $item['total'] }} ر.س</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="cart-update-btn-area">
                        <div class="input-group product-cupon">
                            <input placeholder="ادخل كود الخصم" type="text" class="couponCode">
                            <div class="product-cupon-btn">
                                <button type="submit" class="axil-btn btn-outline couponCheck">تطبيق</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                            <div class="axil-order-summery mt--80">
                                <h5 class="title mb--20">ملخص الطلب</h5>
                                <div class="summery-table-wrap">
                                    <table class="table summery-table mb--30">
                                        <tbody>
                                        <tr class="order-subtotal">
                                            <td>المجموع الفرعي</td>
                                            <td id="cartSub" data-price="{{ $cart->getSubTotal() }}">  {{ $cart->getSubTotal() }} ر.س</td>
                                        </tr>
                                        <tr class="order-shipping">
                                            <td>رسوم الشحن</td>
                                            <td>
                                                @foreach (\App\Models\Shipping::all() as $company)
                                                    @php
                                                        $shippingPrice = getShippingPrice($company);
                                                    @endphp
                                                    @if (getStoreInformation("shipping",0) == 1)
                                                        @if (getStoreInformation("shipping_amount",0) <= $cart->getSubTotal())
                                                            @php
                                                                $shippingPrice = 0;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    <div class="input-group">
                                                        <input type="radio"
                                                            class="changeShippingCompany"
                                                            id="radio{{$company->id}}"
                                                            value="{{ $company->value }}"
                                                            data-price="{{ $shippingPrice }}"
                                                            @if ($cart->shippingBy() == $company->value)
                                                                checked
                                                            @endif
                                                            name="shipping_by">
                                                        <label for="radio{{$company->id}}">{{ $company->name }} : {{ ($shippingPrice == 0) ? 'شحن مجاني' : $shippingPrice.' ر.س' }} </label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr class="order-tax" @if ($cart->getCouponPrice() == 0)
                                            style="display:none"
                                        @endif>
                                            <td>
                                                قيمة الخصم
                                            </td>
                                            <td id="cartCoupon" data-price="{{ $cart->getCouponPrice() }}" style="color: red"> {{ $cart->getCouponPrice() }} ر.س</td>
                                        </tr>
                                        <tr class="order-tax" @if ($cart->getVatPrice() == 0)
                                            style="display:none"
                                        @endif>
                                            <td>قيمة الضريبة</td>
                                            <td id="cartVat" data-price="{{ $cart->getVatPrice() }}"> {{ $cart->getVatPrice() }} ر.س</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>الإجمالي</td>
                                            <td class="order-total-amount" id="cartTotal" data-price="{{ $cart->getTotal() }}">
                                                {{ $cart->getTotal() }}
                                                ر.س
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button class="axil-btn btn-bg-primary checkout-btn" id="checkoutNow" data-url="{{ makeRoute('cart.update') }}">استكمال الطلب</button>
                            </div>
                        </div>
                    </div>
                @else

                    <div style="text-align:center;margin:100px 0px;">
                        <img src="{{ url('/assets/images/cart_empty.gif') }}" style="height:250px;width:250px;margin-bottom:30px;">
                        <p>سلة المشتريات فارغة !</p>
                        <br>
                        <a href="{{ makeRoute('home') }}" class="axil-btn btn-bg-primary checkout-btn">تسوق الان</a>
                    </div>

                @endif



            </div>
        </div>
    </div>
    <!-- End Cart Area  -->

</main>


@endsection
