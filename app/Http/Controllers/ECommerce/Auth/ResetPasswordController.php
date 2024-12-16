<?php

namespace App\Http\Controllers\ECommerce\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        return view("e-commerce.pages.Auth.reset-password");
    }

    public function store(ResetPasswordRequest $request) {
        if(is_null(Session::get('phoneNumber'))) {
            return [
                "status"    => 0,
                "title"     => 'تنبيه',
                "button"    => 'إغلاق',
                "message"   => "برجاء إجراء العمليه مره اخري",
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
            "password"  => Hash::make($request->password)
        ]);
        $request->session()->flash('phoneNumber', null);
        return [
            "status"    => 1,
            "title"     => 'تنبيه',
            "button"    => 'إغلاق',
            "message"   => "تم اعادة تعيين كلمة المرور الجديدة بنجاح",
            "redirect"  => makeRoute('login'),
            "resetInput" => 0,
        ];
    }

    public function reSend() {
        if(is_null(\Session::get('phoneNumber'))) {
            return redirect()->back()->with("danger","هذا الجوال غير موجود لدينا");
        }
        $user = User::where(["phone"=>\Session::get('phoneNumber'),"store_id"=>getStoreIdFormTenancy()])->first();
        if(is_null($user)) {
            return redirect()->back()->with("danger","هذا الجوال غير موجود لدينا");
        }
        // =========================== //
        $otp = (env('SMS_SEND',false)) ? rand(1000,9999) : 1234;
        $user->update([
            "otp"   => $otp
        ]);
        // =========================== //
        if(env('SMS_SEND',false)) {
            (new \App\Support\Jawaly)->setPhone($user->phone)->setMessage($user->otp)->send();
        }
        return redirect()->back()->with("success","تم إعادة إرسال كود التحقق على جوالك");
    }
}
