<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "e_product_images";

    protected $fillable = [
        'product_id',
        'store_id',
        'image',
    ];

    public function scopeTenancy($query){
        return $query->where("store_id",getStoreIdFormTenancy());
    }

    public function getDisplayImageAttribute() {
        return env('APP_SYSTEM_URL')."/".$this->image;
    }

    public function product(){
        return $this->hasOne(\App\Models\Product::class,"id","product_id");
    }

}
