<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('_fixDirSeparator')) {
    function _fixDirSeparator($path) {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}

if (!function_exists('makeRoute')) {
    function makeRoute($name,$parameter = null) {
        if(is_null($parameter)) {
            return route("e-commerce.".$name,request()->route('domain'));
        }
        $p["domain"] = request()->route('domain');
        $p = array_merge($p,$parameter);
        return route("e-commerce.".$name,$p);
    }
}


if (!function_exists('getStoreInformation')) {
    function getStoreInformation($var = null, $default = null,$trans = false) {
        $key  = request()->route('domain')."_settings";
        $data = Cache::rememberForever($key, function () {
            return array_column(\App\Models\Setting::tenancy()->get()->toArray(), 'value', 'key');
        });
        if(is_null($var)) {
            return $data;
        }
        return isset($data[$var]) ? $data[$var] : $default;
    }
}

if (!function_exists('getStoreIdFormTenancy')) {
    function getStoreIdFormTenancy() {
        $key  = request()->route('domain')."-get_tenancy";
        return Cache::rememberForever($key, function () {
            $tenancy = \App\Models\Tenancy::select("store_id")->where("domain_name",request()->route('domain'))->first();
            if(is_null($tenancy)) {
                return 0;
            }
            return $tenancy->store_id;
        });
    }
}

if (!function_exists('getTenancy')) {
    function getTenancy() {
        return Cache::rememberForever("Get_Tenancy", function () {
            return \App\Models\Tenancy::all()->pluck("store_id","domain_name")->toArray();
        });
    }
}

if (!function_exists('getAboutPage')) {
    function getAboutPage() {
        return Cache::rememberForever(getStoreIdFormTenancy()."_about_page", function () {
            return \App\Models\Page::Tenancy()->where("key","about")->first();
        });
    }
}

if (!function_exists('getSliders')) {
    function getSliders() {
        return Cache::rememberForever(getStoreIdFormTenancy()."_sliders", function () {
            return \App\Models\Slider::Tenancy()->get();
        });
    }
}

if (!function_exists('getParentOfCategories')) {
    function getParentOfCategories() {
        return Cache::rememberForever(getStoreIdFormTenancy()."_parent_categories", function () {
            return \App\Models\Category::Tenancy()->whereNull("parent_id")->get();
        });
    }
}

if (!function_exists('getBanks')) {
    function getBanks() {
        return Cache::rememberForever(getStoreIdFormTenancy()."_banks", function () {
            return \App\Models\Bank::Tenancy()->get();
        });
    }
}


if (!function_exists('getShippingPrice')) {
    function getShippingPrice(\App\Models\Shipping $shipping) {
        $ids = [];
        $data = \App\Models\Store::find(getStoreIdFormTenancy())->companies()->get()->toArray();
        if(count($data) > 0) {
            foreach($data as $i) {
                $ids[$i["pivot"]["company_id"]] = $i["pivot"]["price"];
            }
        }
        return (array_key_exists($shipping->id,$ids)) ? $ids[$shipping->id] : $shipping->price;
    }
}
