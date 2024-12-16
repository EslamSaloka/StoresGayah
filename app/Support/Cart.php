<?php

namespace App\Support;
use App\Models\Cart as CartModal;
use App\Models\Cart\Item;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class Cart {

    protected $store_id    = '';
    protected $user        = null;
    protected $cart        = null;
    protected $items       = '';
    protected $vat         = 0;

    public function __construct()
    {
        $this->store_id = getStoreIdFormTenancy();
        $this->user  = Auth::user();
        $this->setVat();
        $this->setCart();
        $this->getItems();
    }

    private function setVat() {
        $this->vat = (int)getStoreInformation("vat",0);
        return $this;
    }

    private function setCart() {
        if(Auth::check()) {
            $this->cart = CartModal::Tenancy()->where("client_id",$this->user->id)->first();
        }
    }

    private function getItems() {
        if(is_null($this->cart)) {
            $this->items = [];
            return;
        }
        $items = [];
        $subTotal = $this->cart->items()->sum('total');
        foreach($this->cart->items()->get() as $item) {
            $items[$item->id] = [
                "id"     => $item->product_id,
                "name"   => $item->product->name,
                "image"  => $item->product->display_image,
                "price"  => ($item->product->offer == 0) ? $item->product->price : $item->product->offer,
                "qty"    => $item->qty,
                "total"  => $item->qty * (($item->product->offer == 0) ? $item->product->price : $item->product->offer),
            ];
        }
        $coupon_price = 0;
        if(!is_null($this->cart->coupon)) {
            $coupon_price = ($this->cart->coupon->type == "fixed") ? ($this->cart->coupon->value) : ( ($subTotal * $this->cart->coupon->value) / 100 );
        }
        $sumVat     = ($this->vat == 0) ? 0 : ((($subTotal - $coupon_price) * 15) / 100);
        $total      = ($subTotal + $sumVat) - $coupon_price + $this->cart->shipping_price;
        $this->cart->update([
            'sub_total'     => $subTotal,
            'vat_price'     => $sumVat,
            'total'         => $total,
            'coupon_price'  => $coupon_price,
        ]);
        $this->items = $items;
        return $this;
    }

    public function showItems() {
        if(is_null($this->cart)) {
            return [];
        }
        return $this->items;
    }

    public function setItem(Product $product,$qty = 1) {
        if(is_null($this->cart)) {
            $newCart = CartModal::create([
                'store_id'  => $this->store_id,
                'client_id' => $this->user->id,
            ]);
            $i = Item::create([
                'cart_id'       => $newCart->id,
                'product_id'    => $product->id,
                'qty'           => $qty,
                'price'         => ($product->offer == 0) ? $product->price : $product->offer,
                "total"         => $qty * (($product->offer == 0) ? $product->price : $product->offer),
            ]);
            $vat = ($this->vat == 0) ? 0 : ($i->total * 15) / 100;
            $newCart->update([
                "sub_total" => $i->total,
                "vat_price" =>  $vat,
                "total"     => $i->total + $vat,
            ]);
            return $this;
        }

        $checkProduct = Item::where([
            "cart_id"       => $this->cart->id,
            "product_id"    => $product->id
        ])->first();
        if(is_null($checkProduct)) {
            Item::create([
                'cart_id'       => $this->cart->id,
                'product_id'    => $product->id,
                'qty'           => $qty,
                'price'         => ($product->offer == 0) ? $product->price : $product->offer,
                "total"         => $qty * (($product->offer == 0) ? $product->price : $product->offer),
            ]);
        } else {
            $checkProduct->update([
                'qty'           => $qty,
                'price'         => ($product->offer == 0) ? $product->price : $product->offer,
                "total"         => $qty * (($product->offer == 0) ? $product->price : $product->offer),
            ]);
        }
        $items = Item::where([
            "cart_id"       => $this->cart->id,
        ]);
        $subTotal   = $items->sum("total");
        $coupon_price = 0;
        if(!is_null($this->cart->coupon)) {
            $coupon_price = ($this->cart->coupon->type == "fixed") ? ($this->cart->coupon->value) : ( ($subTotal * $this->cart->coupon->value) / 100 );
        }
        $sumVat     = ($this->vat == 0) ? 0 : (($subTotal - $coupon_price) * 15) / 100;
        $total      = $subTotal + $sumVat - $coupon_price;
        $this->cart->update([
            "sub_total"     => $subTotal,
            "vat"           => $sumVat,
            "total"         => $total,
            "coupon_price"  => $coupon_price,
        ]);
        return $this;
    }

    public function destroyProduct(Product $product) {
        if(is_null($this->cart)) {
            return false;
        }
        Item::where([
            "cart_id"       => $this->cart->id,
            "product_id"    => $product->id,
        ])->delete();

        $items = Item::where([
            "cart_id"       => $this->cart->id,
        ]);
        if($items->count() == 0) {
            $this->cart->delete();
        }
        $subTotal   = $items->sum("total");
        $sumVat     = ($this->vat == 0) ? 0 : ($subTotal * 15) / 100;
        $total      = $subTotal + $sumVat;
        $this->cart->update([
            "sub_total"     => $subTotal,
            "vat"           => $sumVat,
            "total"         => $total
        ]);

    }

    public function getCart() {
        if(is_null($this->cart)) {
            return 0;
        }
        return $this->cart;
    }

    public function getCount() {
        if(is_null($this->cart)) {
            return 0;
        }
        return $this->cart->items()->count();
    }

    public function getCouponPrice() {
        if(is_null($this->cart)) {
            return 0;
        }
        if($this->getCount() == 0) {
            $this->cart->delete();
            return 0;
        }
        return $this->cart->coupon_price ?? 0;
    }

    public function getVatPrice() {
        if(is_null($this->cart)) {
            return 0;
        }
        if($this->getCount() == 0) {
            $this->cart->delete();
            return 0;
        }
        return $this->cart->vat_price;
    }

    public function getShippingPrice() {
        if(is_null($this->cart)) {
            return 0;
        }
        if($this->getCount() == 0) {
            $this->cart->delete();
            return 0;
        }
        return $this->cart->shipping_price;
    }

    public function getSubTotal() {
        if(is_null($this->cart)) {
            return 0;
        }
        if($this->getCount() == 0) {
            $this->cart->delete();
            return 0;
        }
        return $this->cart->sub_total;
    }

    public function getTotal() {
        if(is_null($this->cart)) {
            return 0;
        }
        if($this->getCount() == 0) {
            $this->cart->delete();
            return 0;
        }
        return $this->cart->total;
    }

    public function shippingBy() {
        if(is_null($this->cart)) {
            return 0;
        }
        return $this->cart->shipping_by;
    }

}
