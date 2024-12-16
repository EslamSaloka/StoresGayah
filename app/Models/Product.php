<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "e_products";

    protected $fillable = [
        'store_id',
        'name',
        'short_description',
        'description',
        "price",
        "offer",
        "rate",
        "star",
        "public",
        "qty",
        "length",
        "width",
        "weight",
    ];

    public function scopeTenancy($query) {
        return $query->where("store_id",getStoreIdFormTenancy())->where('public',1);
    }

    public function categories() {
        return $this->belongsToMany(\App\Models\Category::class, 'e_product_categories_pivot', 'product_id' ,'category_id');
    }

    public function images() {
        return $this->hasMany(\App\Models\Product\Image::class,"product_id","id");
    }

    public function getDisplayImageAttribute() {
        return $this->images()->first()->display_image;
    }

    public function fav() {
        return $this->hasMany(\App\Models\Product\Fav::class,"product_id","id");
    }

    public function rates() {
        return $this->hasMany(\App\Models\Product\Rate::class,"product_id","id");
    }

}
