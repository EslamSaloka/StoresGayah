<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "e_carts";

    protected $fillable = [
        'store_id',
        'client_id',
        'coupon_id',
        'address_id',
        'sub_total',
        'total',
        'shipping_by',
        'shipping_price',
        'coupon_price',
        'vat_price',
        'note',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function items() {
        return $this->hasMany(\App\Models\Cart\Item::class,"cart_id","id");
    }

    public function coupon() {
        return $this->hasOne(\App\Models\Coupon::class,"id","coupon_id");
    }

    public function address() {
        return $this->hasOne(\App\Models\User\Address::class,"id","address_id");
    }

}
