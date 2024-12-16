<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Http\Requests\Ecommerce\Profile\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends ECommerceController
{
    public function index() {
        return view("e-commerce.pages.Profile.index");
    }

    public function store(ProfileUpdateRequest $request) {
        $request = $request->validated();
        // ============================== //
        $checkEmailUniq = User::where("email",$request['email'])->where("store_id",getStoreIdFormTenancy())->first();
        if(!is_null($checkEmailUniq)) {
            if($checkEmailUniq->id != \Auth::user()->id) {
                return [
                    "status"    => 0,
                    "title"     => 'تنبية',
                    "button"    => 'إغلاق',
                    "message"   => "البريد الإلكتروني مستخدم من قبل",
                    "redirect"  => 0,
                ];
            }
        }
        // ================================ //
        $checkPhoneUniq = User::where("phone",$request['phone'])->where("store_id",getStoreIdFormTenancy())->first();
        if(!is_null($checkPhoneUniq)) {
            if($checkPhoneUniq->id != \Auth::user()->id) {
                return [
                    "status"    => 0,
                    "title"     => 'تنبية',
                    "button"    => 'إغلاق',
                    "message"   => "رقم الجوال مستخدم من قبل",
                    "redirect"  => 0,
                ];
            }
        }
        // ======================================= //
        Auth::user()->update($request);
        return [
            "status"    => 1,
            "title"     => 'عملية ناجحة',
            "button"    => 'إغلاق',
            "message"   => "تم تحديث بيانات الحساب الخاصه بك",
            "redirect"  => 0,
        ];
    }

    public function logout() {
        Auth::logout();
        Session::forget('TenancyID');
        return redirect(makeRoute("home"));
    }
}
