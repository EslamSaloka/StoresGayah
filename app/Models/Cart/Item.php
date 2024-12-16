<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = "e_cart_items";

    protected $fillable = [
        'cart_id',
        'product_id',
        'qty',
        'price',
        'total',
    ];

    public function cart() {
        return $this->hasOne(\App\Models\Cart::class,"id","cart_id");
    }

    public function product(){
        return $this->hasOne(\App\Models\Product::class,"id","product_id");
    }

}
