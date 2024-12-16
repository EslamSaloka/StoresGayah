<?php

namespace App\Http\Controllers\ECommerce\Terms;

use App\Http\Controllers\ECommerce\ECommerceController;
use Illuminate\Http\Request;

class TermsController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.Terms.index");
    }
}
