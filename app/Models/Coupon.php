<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = "e_coupons";

    protected $fillable = [
        'store_id',
        'code',
        'value',
        'type',
        'expire_date',
        'expire',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function products() {
        return $this->belongsToMany(\App\Models\Product::class, 'e_coupon_products_pivot', 'coupon_id' ,'product_id');
    }

}
