<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = "e_order_items";

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'total',
    ];

    public function order() {
        return $this->hasOne(\App\Models\Order::class,"id","order_id");
    }

    public function product(){
        return $this->hasOne(\App\Models\Product::class,"id","product_id");
    }

}
