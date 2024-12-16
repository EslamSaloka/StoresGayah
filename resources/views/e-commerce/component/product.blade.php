<div class="col-xl-4 col-sm-6">
    <div class="axil-product product-style-one mb--30">
        <div class="thumbnail">
            <a href="{{ makeRoute('products.show',[$product->id]) }}">
                <img src="{{ $product->display_image }}" alt="{{ $product->name }}" style="height:300px;object-fit:contain;">
            </a>
            <div class="product-hover-action">
                <ul class="cart-action">
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
                        <a href="javascript:void(0);" data-id="{{$product->id}}" data-action="fav" class="callAction">
                            <i class="far fa-heart" @if ($fav)
                            style="color:{{ getStoreInformation('main_color') }}"
                        @endif></i>
                        </a>
                    </li>

                    @if ($product->qty != 0)
                        <li class="select-option">


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

                            @if ($addcart == false)
                                <button disabled href="javascript:void(0);" class="axil-btn btn-bg-primary">
                                    تم الإضافه
                                </button>
                            @else
                                <a href="javascript:void(0);" class="axil-btn btn-bg-primary callAction" data-id="{{$product->id}}" data-action="cart">
                                    إضافة للسلة
                                </a>
                            @endif
                        </li>
                    @else
                        <li class="select-option">
                            <a disabled href="javascript:void(0);" class="axil-btn btn-bg-primary">
                                غير متوفر
                            </a>
                        </li>
                    @endif
                    <li class="quickview">
                        <a href="javascript:void(0);" data-id="{{$product->id}}" data-action="eye" class="callAction">
                            <i class="far fa-eye"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <div class="inner">
                <h5 class="title">
                    <a href="{{ makeRoute('products.show',[$product->id]) }}">
                        {{ $product->name }}
                    </a>
                </h5>
                <div class="product-price-variant">
                    @if ($product->offer != 0)
                        <span class="price current-price">{{$product->offer}} ر.س</span>
                        <span class="price old-price">{{$product->price}} ر.س</span>
                    @else
                        <span class="price">{{$product->price}} ر.س</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
