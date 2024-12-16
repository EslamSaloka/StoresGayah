<?php

namespace App\Http\Controllers\ECommerce\About;

use App\Http\Controllers\ECommerce\ECommerceController;

class AboutController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.About.index");
    }
}
