<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Models\Product\Fav;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends ECommerceController
{
    public function index() {
        $ids = Fav::Tenancy()->where("client_id",Auth::user()->id)->pluck("product_id")->toArray();
        $products = Product::Tenancy()->whereIn("id",$ids)->get();
        return view("e-commerce.pages.Products.fav",get_defined_vars());
    }
}
