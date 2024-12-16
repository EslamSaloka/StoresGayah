<?php

namespace App\Http\Controllers\ECommerce\Carts;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shipping;
use Carbon\Carbon;

class CartsController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.Carts.index");
    }

    public function ajaxUpdateCart() {
        $cart = (new \App\Support\Cart)->getCart();
        $data = [];
        $shipping = null;
        $coupon = null;
        $OOPP   = 'كود الخصم غير صحيح';
        if(request()->has('coupon')) {
            $coupon    = Coupon::Tenancy()->where("code",request("coupon"))->first();
            if(!is_null($coupon)) {
                if(Carbon::parse($coupon->expire_date)->format('d-m-Y') <= Carbon::now()->format('d-m-Y')) {
                    $coupon = null;
                    $OOPP = "هذا الكود منتهي الصلاحية";
                } else {
                    $couponProductsIds = (is_null($coupon->products())) ? [] : $coupon->products()->pluck("product_id")->toArray() ?? [];
                    if(count($couponProductsIds) > 0) {
                        $PP = array_diff_assoc($cart->items()->pluck("product_id")->toArray(),$couponProductsIds);
                        if(count($PP) > 0) {
                            $coupon = null;
                            $OOPP = "هذا الكوبون غير متاح لبعض المنتجات في السله";
                        }
                    }
                }
            }
        }
        if(request()->has('shipping_by')) {
            $shipping    = Shipping::where("value",request("shipping_by"))->first();
            if(!is_null($shipping)) {
                $data["shipping_by"]    = $shipping->value;
                $shippingPrice = getShippingPrice($shipping);
                if (getStoreInformation("shipping",0) == 1) {
                    if (getStoreInformation("shipping_amount",0) <= $cart->sub_total) {
                        $shippingPrice = 0;
                    }
                }
                $data["shipping_price"] = $shippingPrice;
            }
        } else {
            $data["shipping_by"]    = $cart->shipping_by ?? '';
            $data["shipping_price"] = $cart->shipping_price ?? 0;
        }
        if(count($data) > 0) {
            $sub = $cart->items()->sum("total");
            $vat                    = (getStoreInformation("vat",0) == 0) ? 0 : ($sub * getStoreInformation("vat",0)) / 100;
            $data['vat_price']      = $vat;
            $data['sub_total']      = $sub;
            if(!is_null($coupon)) {
                $c = ($coupon->type == "fixed") ? ($coupon->value) : ( ($sub * $coupon->value) / 100 );
                $data['coupon_id']      = $coupon->id;
                $data['coupon_price']   = $c;
                $data['total']          = ($sub - $c) + $vat + $data["shipping_price"] ?? 0;
            } else {
                if(request()->has('coupon')) {
                    $data['coupon_id']      = null;
                    $data['coupon_price']   = 0;
                    $data['total']          = $sub + $vat + $data["shipping_price"] ?? 0;
                } else {
                    $data['total']          = ($sub - $cart->coupon_price ) + $vat + $data["shipping_price"] ?? 0;
                }
            }
            $cart->update($data);
        }
        if(!request()->has('shipping_by')) {
            if(is_null($coupon)) {
                return [
                    "redirect"  => '123',
                    "status"    => 0,
                    "message"   => $OOPP,
                ];
            }
        }
        return [
            "status"    => 1,
            "redirect"  => makeRoute('check-out.index')
        ];
    }

    public function ajaxDeleteCart($domain_name,Product $product) {
        $cart = (new \App\Support\Cart);
        $cart->destroyProduct($product);
        return [
            "count" => $cart->getCount(),
            "total" => $cart->getTotal()." ر.س",
        ];
    }

    public function addOrRemoveQty($domain_name,Product $product) {
        $cart = (new \App\Support\Cart);
        $cart->setItem($product,request('qty'));
        return true;
    }
}
