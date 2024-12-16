<?php

namespace App\Http\Controllers\ECommerce\Contact;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Http\Requests\Ecommerce\Contact\ContactStore;
use App\Models\Contact;

class ContactController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.Contact.index");
    }

    public function store(ContactStore $request) {
        Contact::create($request->validated());
        return [
            "status"    => 1,
            "title"     => 'شكرا لك',
            "button"    => 'إغلاق',
            "message"   => "شكرا لك علي إرسال الرساله لنا",
            "redirect"  => 0,
            "resetInput" => 1,
        ];
    }
}
