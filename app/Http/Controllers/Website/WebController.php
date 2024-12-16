<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index() {
        return view("website.pages.index");
    }

    public function about() {
        return view("website.pages.about");
    }

    public function faq() {
        return view("website.pages.faq");
    }

    public function policy() {
        return view("website.pages.policy");
    }

    public function terms() {
        return view("website.pages.terms");
    }

    public function contact() {
        return view("website.pages.contact");
    }

    public function contactStore() {
        dd(request()->all());
    }
}
