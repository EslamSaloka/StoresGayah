<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Http\Requests\Ecommerce\Profile\AddressStoreRequest;
use App\Models\User\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AddressController extends ECommerceController
{

    public function store(AddressStoreRequest $request) {
        Address::create($request->validated());
        return [
            "status"     => 1,
            "title"      => 'عملية ناجحة',
            "button"     => 'إغلاق',
            "message"    => "تم إضافه العنوان بنجاح",
            "redirect"   => makeRoute("check-out.index"),
            "resetInput" => 0,
        ];
    }

    public function destroy($domain,Address $address) {
        $address->delete();
        return 1;
    }

}
