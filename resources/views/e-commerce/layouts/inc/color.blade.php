@php
    $mainColor = getStoreInformation('main_color');
@endphp
<style>
    .paginaterActive {
        color:#fff !important;
        background-color: {{$mainColor}} !important;
    }
    .paginaterActive a{
        color:#fff !important;
    }
    .style-error {
        border: 1px solid red !important;
    }
    .text-error {
        color: red !important;
    }
    /* .swal2-popup {
        width: 50em !important;
    } */
    .swal2-styled.swal2-confirm {
        width:20em;
        color:#fff !important;
        background-color: {{$mainColor}} !important;
        box-shadow: none !important;
    }
    .swal2-popup button {
        /* width: 20em !important; */
        color: black !important;
        background: {{$mainColor}} !important;
    }
    .swal2-container.swal2-center>.swal2-popup {
        font-size: 15px !important;
    }
</style>
<style>

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{
        color: {{ $mainColor }} !important;
    }
.axil-mainmenu.aside-category-menu .header-department .header-department-text{
    background: {{ $mainColor }} !important;
}

ul li a:hover{
    color: {{ $mainColor }} !important;
}

.header-action > ul > li > a::after{
    background-color:{{ $mainColor }} !important;
}

.header-action > ul > li > a::after{
    color: #fff !important;
}

.axil-product .cart-action li.select-option a:hover{
    color: #fff !important;
}

.header-action .shopping-cart .cart-dropdown-btn .cart-count{
    background-color:{{ $mainColor }} !important;
}
.header-style-2 .axil-header-top .axil-search input{
    border: 1px solid {{ $mainColor }} !important;
}

.axil-product .cart-action li.select-option a:before{
    background-color:{{ $mainColor }} !important;
}

a:hover, a:focus, a:active{
    color: {{ $mainColor }} !important;
}
.social-share a:after{
    background-color:{{ $mainColor }} !important;
}

.header-action > ul > li > a:hover{
    color: #fff !important;
}

.mainmenu > li > a.active{
    color: {{ $mainColor }} !important;
}

.form-group input:focus{
    border-color: {{ $mainColor }} !important;
}
.footer-style-2 .copyright-default .social-share a:hover{
    color: #fff !important;
}

.social-share a:hover{
    color: #fff !important;
}
.back-to-top{
    background-color:{{ $mainColor }} !important;
}

.back-to-top.show:hover{
    color: #fff !important;
}

.axil-shop-sidebar .product-categories ul li.current-cat a::before, .axil-shop-sidebar .product-categories ul li.chosen a::before{
    background:{{ $mainColor }} !important;
    border-color: {{ $mainColor }} !important;
}
.axil-shop-sidebar .title::after{
    background:{{ $mainColor }} !important;
}

.post-pagination nav.pagination ul li span.current{
    background:{{ $mainColor }} !important;
    border-color: {{ $mainColor }} !important;
}
.post-pagination nav.pagination ul li a:hover{
    background:{{ $mainColor }} !important;
    border-color: {{ $mainColor }} !important;
    color: #fff !important;
}

.header-style-5 .header-action .axil-search input{
    border: 1px solid {{ $mainColor }} !important;
}
.small-thumb-wrapper .small-thumb-img:hover img, .small-thumb-wrapper .small-thumb-img.slick-current img{
    border-color: {{ $mainColor }} !important;
}

.single-product-content .inner .product-meta li{
    color: {{ $mainColor }} !important;
}

a.axil-btn.btn-bg-primary, button.axil-btn.btn-bg-primary{
    background-color:{{ $mainColor }} !important;
    color: #fff !important;
}
a.axil-btn.btn-bg-primary:before, button.axil-btn.btn-bg-primary:before{
    background-color:{{ $mainColor }} !important;
    color: #fff !important;
}

a.axil-btn.wishlist-btn:hover, button.axil-btn.wishlist-btn:hover{
    border-color: {{ $mainColor }} !important;
}

a.axil-btn.wishlist-btn:before, button.axil-btn.wishlist-btn:before{
    background-color:{{ $mainColor }} !important;
}
.pro-qty .qtybtn:hover{
    border-color: {{ $mainColor }} !important;
}

.woocommerce-tabs ul.tabs li a.active, .woocommerce-tabs ul.tabs li a:hover{
    color: {{ $mainColor }} !important;
}

.woocommerce-tabs ul.tabs li a:after{
    background-color:{{ $mainColor }} !important;
}

.axil-breadcrumb li.axil-breadcrumb-item.active{
    color: {{ $mainColor }} !important;
}

.axil-dashboard-aside .nav-link.active, .axil-dashboard-aside .nav-link:hover{
    color: {{ $mainColor }} !important;
}

input[type=submit]{
    background-color:{{ $mainColor }} !important;
    border-color: {{ $mainColor }} !important;
}

input[type=submit]:hover{
    color: #fff !important;
}

.axil-product-table tbody td.product-add-cart .btn-outline:hover{
    border-color: {{ $mainColor }} !important;
    color: #fff !important;
}

a.axil-btn.btn-outline:hover, button.axil-btn.btn-outline:hover{
    background-color:{{ $mainColor }} !important;
}

.product-table-heading .cart-clear{
    color: {{ $mainColor }} !important;
}

.axil-product-table tbody td.product-remove .remove-wishlist:hover{
    border-color: {{ $mainColor }} !important;
}

.axil-product-cart-wrap .product-cupon .axil-btn:hover{
    border-color: {{ $mainColor }} !important;
}

.axil-product-cart-wrap .product-cupon input{
    border-bottom: 2px solid {{ $mainColor }} !important;
}

.axil-product-cart-wrap .product-cupon .axil-btn{
    border-color: {{ $mainColor }} !important;
}
input[type=checkbox]:checked ~ label::before, input[type=radio]:checked ~ label::before{
    background-color:{{ $mainColor }} !important;
    border-color: {{ $mainColor }} !important;
}

.axil-order-summery .summery-table .order-shipping .input-group label:after{
    background-color:{{ $mainColor }} !important;
}

.axil-order-summery .summery-table .order-total-amount{
    color: {{ $mainColor }} !important;
}

.success_order{
    background-color:{{ $mainColor }} !important;
}

.header-search-modal .card-close:hover{
    background-color:{{ $mainColor }} !important;
}
.mobile-close-btn:hover{
    background-color:{{ $mainColor }} !important;
}

.form-group textarea:focus{
    border-color: {{ $mainColor }} !important;
}
.axil-mainmenu.aside-category-menu .header-department .department-nav-menu .sidebar-close:hover{
    background-color:{{ $mainColor }} !important;
}

.cart-dropdown .cart-item .item-img .close-btn:hover{
    background-color:{{ $mainColor }} !important;
}

.axil-mainmenu.aside-category-menu .header-department .department-nav-menu .nav-link:hover:after{
    color: {{ $mainColor }} !important;
}
.axil-dashboard-order .table tbody .view-btn{
    border-color: {{ $mainColor }} !important;
}

.axil-dashboard-order .table tbody .view-btn:hover{
    background-color:{{ $mainColor }} !important;
    color: #fff !important;
}

.print_btn{
    border-color: {{ $mainColor }} !important;
    color: #000 !important;
}

.print_btn:hover{
    background-color:{{ $mainColor }} !important;
    color: #fff !important;
}

.cart-dropdown .cart-item .item-quantity .qtybtn:hover{
    background-color:{{ $mainColor }} !important;
}

a.axil-btn.btn-outline, button.axil-btn.btn-outline{
    border-color: {{ $mainColor }} !important;
}

.header-search-modal .card-header .form-control{
    border-color: {{ $mainColor }} !important;
}
.header-search-modal .card-header .axil-btn i{
    color: #fff !important;
}

.featured_icons{
    color: {{ $mainColor }} !important;
}

.category-select .single-select{
    border-color: {{ $mainColor }} !important;
}

.quick-view-product .modal-header .btn-close:after{
    background-color:{{ $mainColor }} !important;
}

.product-quick-view a:hover{
    background-color:{{ $mainColor }} !important;
    color: #fff !important;
}

.axil-product.product-list-style-3 .product-content .product-price-variant .price{
    color: {{ $mainColor }} !important;
}

.cart-dropdown .cart-header .cart-close:hover{
    background-color:{{ $mainColor }} !important;
}
</style>
