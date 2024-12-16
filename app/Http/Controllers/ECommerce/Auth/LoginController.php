<?php

namespace App\Http\Controllers\ECommerce\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return redirect(makeRoute("home"));
        }
        return view("e-commerce.pages.Auth.login");
    }

    public function store(LoginRequest $request) {
        if( Auth::attempt($request->validated(), $request->boolean('remember'))) {
            if(Auth::user()->store_id != getStoreIdFormTenancy()) {
                Auth::logout();
                return [
                    "status"    => 0,
                    "title"     => 'تنبيه',
                    "button"    => 'إغلاق',
                    "message"   => "هذا الجوال غير مسجل لدينا",
                    "redirect"  => 0,
                    "resetInput" => 0,
                ];
            }
            if(Auth::user()->suspend == 1) {
                Auth::logout();
                return [
                    "status"    => 0,
                    "title"     => 'تنبيه',
                    "button"    => 'إغلاق',
                    "message"   => "لقد تم حجب الحساب الخاص بكم من قبل ادارة المتجر",
                    "redirect"  => 0,
                    "resetInput" => 0,
                ];
            }
            if(is_null(Auth::user()->phone_verified_at)) {
                Session::put('phoneNumber',Auth::user()->phone);
                if(env('SMS_SEND',false)) {
                    (new \App\SMS\SMS)->setPhone(Auth::user()->phone)->setMessage(Auth::user()->otp)->build();
                }
                Auth::logout();
                return [
                    "status"    => 0,
                    "title"     => 'تنبيه',
                    "button"    => 'إغلاق',
                    "message"   => "برجاء تفعيل الحساب الخاص بك اولا",
                    "redirect"  => makeRoute("otp.index"),
                    "resetInput" => 0,
                ];
            }
            Session::put('TenancyID',getStoreIdFormTenancy());
            return [
                "status"    => 1,
                "message"   => "",
                "redirect"  => makeRoute("home"),
                "resetInput" => 0,
            ];
        }
        return [
            "status"    => 0,
            "title"     => 'تنبيه',
            "button"    => 'إغلاق',
            "message"   => "رقم الجوال او كلمة المرور غير صحيحة",
            "redirect"  => 0,
            "resetInput" => 0,
        ];
    }
}
