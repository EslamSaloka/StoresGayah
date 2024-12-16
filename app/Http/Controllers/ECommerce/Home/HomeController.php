<?php

namespace App\Http\Controllers\ECommerce\Home;

use App\Http\Controllers\ECommerce\ECommerceController;
use Illuminate\Http\Request;

class HomeController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.Home.index");
    }
}
