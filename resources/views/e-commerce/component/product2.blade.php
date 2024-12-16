<div class="slick-single-layout">
    <div class="axil-product product-style-two">
        <div class="thumbnail">
            <a href="{{ makeRoute('products.show',[$product->id]) }}">
                <img data-sal="zoom-out" data-sal-delay="200" data-sal-duration="500" src="{{ $product->display_image }}" alt="{{ $product->name }}">
            </a>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title"><a href="{{ makeRoute('products.show',[$product->id]) }}">{{ $product->name }}</a></h5>
                <div class="product-price-variant">
                    <span class="price current-price">{{ ($product->offer == 0) ? $product->price : $product->offer }} ر.س</span>
                </div>
                <div class="product-hover-action">
                    <ul class="cart-action">
                        <li class="quickview"><a href="javascript:void(0);" data-id="{{$product->id}}" data-action="eye" class="callAction"><i class="far fa-eye"></i></a></li>

                        @if ($product->qty != 0)
                            @if (\Auth::check())
                                @php
                                    $cart = (new \App\Support\Cart);
                                    $addcart        = true;
                                    if($cart->getCount() > 0) {
                                        if(is_numeric(array_search($product->id, array_column($cart->showItems(), 'id')))) {
                                            $addcart        = false;
                                        }
                                    }
                                @endphp
                            @else
                                @php
                                    $addcart = true;
                                @endphp
                            @endif
                            <li class="select-option">
                                @if ($addcart == false)
                                    <a disabled>تم الإضافه</a>
                                @else
                                    <a href="javascript:void(0);" data-id="{{$product->id}}" data-action="cart" class="callAction">إضافة للسلة</a>
                                @endif
                            </li>
                        @else
                            <li class="select-option">
                                <a href="javascript:void(0);">
                                    غير متوفر
                                </a>
                            </li>
                        @endif
                        @if (\Auth::check())
                            @php
                                $fav        = false;
                                $productIds = \Auth::user()->advFav()->where("store_id",getStoreIdFormTenancy())->pluck('product_id')->toArray();
                                if(in_array($product->id,$productIds)) {
                                    $fav  = true;
                                }
                            @endphp
                        @else
                            @php
                                $fav = false;
                            @endphp
                        @endif
                        <li class="wishlist">
                            <a href="javascript:void(0);" data-id="{{$product->id}}" data-action="fav" class="callAction"><i @if ($fav)
                                style="color:{{ getStoreInformation('main_color') }}"
                            @endif class="far fa-heart"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
