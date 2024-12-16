<?php

namespace App\Http\Controllers\ECommerce;

use App\Http\Controllers\Controller;

class ECommerceController extends Controller
{
    protected $domainStoreId = '';
    protected $domainNAME    = '';

    public function __construct()
    {
        if(!array_key_exists(request()->route('domain'),getTenancy())) {
            abort(404);
        }
        $this->domainNAME       = request()->route('domain');
        $this->domainStoreId    = getTenancy()[request()->route('domain')];
    }
}
