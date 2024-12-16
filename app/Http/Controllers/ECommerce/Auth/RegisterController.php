<?php

namespace App\Http\Controllers\ECommerce\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view("e-commerce.pages.Auth.register");
    }

    public function store(RegisterRequest $request) {
        $data = $request->validated();

        // =============================== //
        // +++++++++ Check Phone ++++++++++//
        // =============================== //
        $phone = User::where("phone",$request->phone)->first();
        if(!is_null($phone)) {
            if($phone->store_id == getStoreIdFormTenancy()) {
                return [
                    "status"    => 0,
                    "title"     => 'تنبيه',
                    "button"    => 'إغلاق',
                    "message"   => "هذا الجوال مستخدم من قبل",
                    "redirect"  => 0,
                    "resetInput" => 0,
                ];
            }
        }
        // =============================== //
        // +++++++++ Check Email ++++++++++//
        // =============================== //
        $email = User::where("email",$request->email)->first();
        if(!is_null($email)) {
            if($email->store_id == getStoreIdFormTenancy()) {
                return [
                    "status"    => 0,
                    "title"     => 'تنبيه',
                    "button"    => 'إغلاق',
                    "message"   => "هذا البريد الالكتروني مستخدم من قبل",
                    "redirect"  => 0,
                    "resetInput" => 0,
                ];
            }
        }


        $data["password"]   = Hash::make($request->password);
        $data["otp"]        = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user               = User::create($data);
        Session::put('phoneNumber',$user->phone);
        if(env('SMS_SEND',false)) {
            (new \App\SMS\SMS)->setPhone($user->phone)->setMessage($user->otp)->build();
        }
        return [
            "status"    => 1,
            "title"     => 'تنبيه',
            "button"    => 'إغلاق',
            "message"   => "برجاء التحقق من رمز التحقق المرسل على الجوال الخاص بك",
            "redirect"  => makeRoute("otp.index"),
            "resetInput" => 0,
        ];
    }
}
