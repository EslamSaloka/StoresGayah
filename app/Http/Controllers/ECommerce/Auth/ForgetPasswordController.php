<?php

namespace App\Http\Controllers\ECommerce\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Auth\ForgetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ForgetPasswordController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view("e-commerce.pages.Auth.forget-password");
    }

    public function store(ForgetPasswordRequest $request) {
        $user = User::where(["phone"=>$request->phone,"store_id"=>getStoreIdFormTenancy()])->first();
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
        $otp = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user->update([
            "otp"   => $otp
        ]);
        if(env('SMS_SEND',false)) {
            (new \App\SMS\SMS)->setPhone($user->phone)->setMessage($otp)->build();
        }
        Session::put('phoneNumber',$user->phone);
        return [
            "status"    => 1,
            "title"     => 'تنبيه',
            "button"    => 'إغلاق',
            "message"   => "تم إرسال كود التحقق علي الجوال الخاص بك",
            "redirect"  => makeRoute('reset-password.index'),
            "resetInput" => 0,
        ];
    }
}
