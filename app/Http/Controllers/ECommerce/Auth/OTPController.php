<?php

namespace App\Http\Controllers\ECommerce\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Auth\OTPRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OTPController extends Controller
{
    public function index() {
        if(Auth::check()) {
            if(is_null(Auth::user()->phone_verified_at)) {
                return view("e-commerce.pages.Auth.otp");
            }
            return redirect()->route('home');
        }
        return view("e-commerce.pages.Auth.otp");
    }

    public function store(OTPRequest $request) {
        if(is_null(Session::get('phoneNumber'))) {
            return [
                "status"    => 0,
                "title"     => 'تنبيه',
                "button"    => 'إغلاق',
                "message"   => "برجاء إجراء العملية مره اخري",
                "redirect"  => makeRoute('forget-password.index'),
                "resetInput" => 0,
            ];
        }
        $user = User::where(["phone"=>Session::get('phoneNumber'),"store_id"=>getStoreIdFormTenancy()])->first();
        if(is_null($user)) {
            return [
                "status"    => 0,
                "title"     => 'تنبيه',
                "button"    => 'إغلاق',
                "message"   => "هذا الجوال غير موجود لدينا",
                "redirect"  => 0,
                "resetInput" => 0,
            ];
        }
        if($user->otp != $request->otp) {
            return [
                "status"    => 0,
                "title"     => 'تنبيه',
                "button"    => 'إغلاق',
                "message"   => "كود التحقق غير صحيح",
                "redirect"  => 0,
                "resetInput" => 0,
            ];
        }
        $user->update([
            "phone_verified_at" => \Carbon\Carbon::now(),
            "otp"               => (env('SMS_SEND',false)) ? rand(1000,9999) : 1234
        ]);
        Auth::login($user);
        return [
            "status"    => 1,
            "title"     => 'تنبيه',
            "button"    => 'إغلاق',
            "message"   => "شكرا لك علي تفعيل حسابك",
            "redirect"  => makeRoute("home"),
            "resetInput" => 0,
        ];
    }
}
