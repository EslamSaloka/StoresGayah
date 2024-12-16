<div class="single-product-thumb">
    <div class="row">
        <div class="col-lg-7 mb--40">
            <div class="row">
                <div class="col-lg-12 order-lg-2">
                    <div class="single-product-thumbnail product-large-thumbnail axil-product thumbnail-badge zoom-gallery">

                        @foreach ($product->images()->orderBy("id","desc")->get() as $image)
                            <div class="thumbnail">
                                <img src="{{ $image->display_image }}" alt="Product Images">
                                <div class="product-quick-view position-view">
                                    <a href="{{ $image->display_image }}" class="popup-zoom">
                                        <i class="far fa-search-plus"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 mb--40">
            <div class="single-product-content">
                <div class="inner">
                    <a href="{{ makeRoute('products.show',[$product->id]) }}">
                        <h3 class="product-title">
                            {{ $product->name }}
                        </h3>
                    </a>
                    <div class="product-rating">
                        <div class="star-rating">
                            @for ($i=0;$i<$product->rate;$i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for ($i=5;$i > $product->rate;$i--)
                                <i class="far fa-star" style=" color: black; "></i>
                            @endfor
                        </div>
                        <div class="review-link">
                            <a href="#">(<span>{{ $product->rate }}</span> تقييمات المستخدمين)</a>
                        </div>
                    </div>
                    <span class="price-amount">{{ $product->price }} ر.س</span>
                    <p class="description">
                        {{ $product->short_description }}
                    </p>
                    <p>الكمية المتوفرة : {{ $product->qty }}</p>
                    <div class="product-variations-wrapper">
                        <!-- Start Product Variation  -->
                        <div class="product-variation">
                            <h6 class="title">الوزن:</h6>
                            <ul class="range-variant">
                                <li>{{ $product->weight }} كجم</li>
                            </ul>
                        </div>
                        <!-- End Product Variation  -->

                    </div>

                    <!-- Start Product Action Wrapper  -->
                    <div class="product-action-wrapper d-flex-center">
                        <!-- Start Product Action  -->
                        <ul class="product-action d-flex-center mb--0">
                            <li class="add-to-cart">
                                <a href="javascript:void(0);" class="axil-btn btn-bg-primary callAction" data-id="{{$product->id}}" data-action="cart">إضافة للسلة</a>
                            </li>
                            <li class="wishlist">
                                <a href="javascript:void(0);" class="axil-btn wishlist-btn callAction" data-id="{{$product->id}}" data-action="fav">
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Product Action  -->
                    </div>
                    <!-- End Product Action Wrapper  -->
                </div>
            </div>
        </div>
    </div>
</div>
