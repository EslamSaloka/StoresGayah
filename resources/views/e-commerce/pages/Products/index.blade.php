@extends('e-commerce.layouts.master')
@section('title')
    المنتجات
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
                            <li class="axil-breadcrumb-item active" aria-current="page">قائمة المنتجات</li>
                        </ul>
                        <h1 class="title">تصفح المنتجات</h1>
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
                <div class="col-lg-3">
                    <div class="axil-shop-sidebar">
                        <div class="d-lg-none">
                            <button class="sidebar-close filter-close-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <div class="toggle-list product-categories active">
                            <h6 class="title">الأقسام</h6>
                            <div class="shop-submenu">
                                <ul>
                                    @foreach (getParentOfCategories() as $category)
                                        <li @if (request("category_id",0) == $category->id)
                                            class="current-cat"
                                        @endif>
                                            <a href="{{ makeRoute("products.index",["category_id"=>$category->id]) }}">
                                                {{ $category->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if (request()->has("category_id") && request("category_id") != 0)
                        <div class="axil-shop-sidebar">
                            <div class="d-lg-none">
                                <button class="sidebar-close filter-close-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="toggle-list product-categories active">
                                <h6 class="title">
                                    الأقسام الفرعية
                                </h6>
                                <div class="shop-submenu">
                                    <ul>
                                        @foreach (\App\Models\Category::where("parent_id",request("category_id"))->get() as $cat)
                                            @php
                                                $su = explode(",",request("sub_id",0))
                                            @endphp
                                            <li @if (in_array($cat->id,$su))
                                                class="current-cat"
                                            @endif>
                                                <input type="checkbox" @if (in_array($cat->id,$su))
                                                    checked
                                                @endif class="co" id="sub_{{$cat->id}}" value="{{ $cat->id }}" name="sub_id[]">
                                                <a href="javascript:void(0);" class="oop" for="sub_{{$cat->id}}">
                                                    {{ $cat->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- End .axil-shop-sidebar -->
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="axil-shop-top mb--40">
                                <div class="category-select align-items-center justify-content-lg-end justify-content-between">
                                    <!-- Start Single Select  -->
                                    <select class="single-select">
                                        <option value="{{ makeRoute("products.index",["category_id"=>request('category_id',0),"sub_id"=>request('sub_id',0)]) }}">ترتيب حسب</option>
                                        <option @if (request()->has('price') && request('price') == "asc")
                                            selected
                                        @endif value="{{ makeRoute("products.index",["category_id"=>request('category_id',0),"sub_id"=>request('sub_id',0),'price'=>'asc']) }}">  من الاقل سعرا الى الاعلى</option>
                                        <option @if (request()->has('price') && request('price') == "desc")
                                            selected
                                        @endif value="{{ makeRoute("products.index",["category_id"=>request('category_id',0),"sub_id"=>request('sub_id',0),'price'=>'desc']) }}"> من الاعلى سعرا للأقل</option>
                                    </select>
                                    <!-- End Single Select  -->
                                </div>
                                <div class="d-lg-none">
                                    <button class="product-filter-mobile filter-toggle"><i class="fas fa-filter"></i>تصفية حسب القسم</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End .row -->
                    <div class="row row--15">
                        @foreach ($products as $product)
                            @include('e-commerce.component.product',["product"=>$product])
                        @endforeach
                    </div>

                    <div class="text-center pt--20 mb--100">
                        <div class="post-pagination">
                            {{ $products->withQueryString()->withQueryString()->links('e-commerce.component.paginator') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .container -->
    </div>
    <!-- End Shop Area  -->

</main>

@endsection
@push('scripts')
    <script>
        $(".oop").click(function(){
           if($(this).parent().hasClass('current-cat') == true) {
                $(this).parent().removeClass("current-cat");
                $(this).parent().find(".co").attr('checked',false);
            } else {
               $(this).parent().addClass("current-cat");
               $(this).parent().find(".co").attr('checked',true);
            }
            var arr = [];
            $(':checkbox:checked').each(function(i){
               arr[i] = $(this).val();
            });
            var sub = arr.toString();
            if(sub == '') {
                window.location.href = '{{ makeRoute("products.index",["category_id"=>request("category_id",0)]) }}';
            } else {
                window.location.href = '{{ makeRoute("products.index",["category_id"=>request("category_id",0)]) }}&sub_id='+sub;
            }
        });
        $('.single-select').change(function() {
            window.location.href = $(this).val();
        });
    </script>
@endpush
