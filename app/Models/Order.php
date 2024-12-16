<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "e_orders";

    protected $fillable = [
        'store_id',
        'client_id',
        'coupon_id',
        'address_id',
        'shipping_by',
        'shipping_id',
        'note',
        // ======================= //
        'sub_total',
        'total',
        'shipping_price',
        'coupon_price',
        'vat_price',
        'cod_fees',
        // ======================= //
        'payment_status',
        'payment_type',
        'status',
        'image',
        // ======================= //
        'tracking_id',
        // ======================= //
        'payment_id',
        'transaction_id',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function user() {
        return $this->hasOne(\App\Models\User::class,"id","client_id");
    }

    public function items() {
        return $this->hasMany(\App\Models\Order\Item::class,"order_id","id");
    }

    public function coupon() {
        return $this->hasOne(\App\Models\Coupon::class,"id","coupon_id");
    }

    public function address() {
        return $this->hasOne(\App\Models\User\Address::class,"id","address_id");
    }

}
