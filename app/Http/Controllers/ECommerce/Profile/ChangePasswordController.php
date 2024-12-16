<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Http\Requests\Ecommerce\Profile\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends ECommerceController
{

    public function store(ChangePasswordRequest $request) {
        if(!Hash::check($request->old_password,Auth::user()->password)) {
            return [
                "status"    => 0,
                "title"     => 'تنبية',
                "button"    => 'إغلاق',
                "message"   => "كلمة المرور الحالية الخاصه بك غير صحيحة",
                "redirect"  => 0,
                "resetInput" => 0,
            ];
        }
        \Auth::user()->update($request->validated());
        return [
            "status"     => 1,
            "title"      => 'عملية ناجحة',
            "button"     => 'إغلاق',
            "message"    => "تم تحديث كلمه المرور الخاصه بك",
            "redirect"   => 0,
            "resetInput" => 1,
        ];
    }

}
