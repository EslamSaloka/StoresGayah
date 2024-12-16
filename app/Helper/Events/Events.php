<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

\App\Models\Contact::creating(function(\App\Models\Contact $contact){
    $contact->store_id = getStoreIdFormTenancy();
});

\App\Models\User\Address::creating(function(\App\Models\User\Address $address){
    $address->store_id = getStoreIdFormTenancy();
    $address->client_id = Auth::user()->id;
});

\App\Models\User::creating(function(\App\Models\User $user){
    $user->store_id = getStoreIdFormTenancy();
});

\App\Models\Product\Fav::creating(function(\App\Models\Product\Fav $fav){
    $fav->store_id = getStoreIdFormTenancy();
});

\App\Models\Product\Rate::creating(function(\App\Models\Product\Rate $rate){
    $rate->client_id = Auth::user()->id;
});

\App\Models\Order::creating(function(\App\Models\Order $order){
    $cart                   = (new \App\Support\Cart)->getCart();
    $order->store_id        = getStoreIdFormTenancy();
    $order->client_id       = Auth::user()->id;
    $order->coupon_id       = $cart->coupon_id;
    $order->sub_total       = $cart->sub_total;
    $order->shipping_by     = $cart->shipping_by;
    $order->shipping_price  = $cart->shipping_price ?? 0;
    $order->coupon_price    = $cart->coupon_price ?? 0;
    $order->vat_price       = $cart->vat_price ?? 0;


    if(request()->has("payment_type")) {
        if(request("payment_type") == "bank") {
            if(request()->hasFile("image")) {
                $order->image = (new \App\Support\Image)->FileUpload(request("image"),"bank");
            }
            $order->total       = $cart->total;
        } elseif(request("payment_type") == "cod") {
            $order->total       = $cart->total + 10;
            $order->cod_fees    = 10;
        } else {
            $order->total  = $cart->total;
        }
    } else {
        $order->total  = $cart->total;
    }
});

\App\Models\User::updating(function(\App\Models\User $user){
    if(request()->has("avatar")) {
        $user->avatar = (new \App\Support\Image)->FileUpload(request("avatar"),"clients");
    }
    if(request()->has("password") && request("password") != '' && !is_null(request("password"))) {
        $user->password = Hash::make(request("password"));
    }
});
