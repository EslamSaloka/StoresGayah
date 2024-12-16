<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fav extends Model
{
    use HasFactory;

    protected $table = "e_product_fav";

    protected $fillable = [
        'store_id',
        'product_id',
        'client_id',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function client() {
        return $this->hasOne(\App\Models\User::class,"id","client_id");
    }

    public function product(){
        return $this->hasOne(\App\Models\Product::class,"id","product_id");
    }

}
