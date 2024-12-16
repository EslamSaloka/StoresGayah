<?php

namespace App\Http\Controllers\ECommerce\Profile;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Models\Order;

class OrdersController extends ECommerceController
{

    public function show($domain,Order $order) {
        return view("e-commerce.pages.CheckOut.show",get_defined_vars());
    }

    public function showPolicy($domain,Order $order) {
        $shipping = \App\Models\System\Shipping::find($order->shipping_id);
        if(is_null($shipping)) {
            abort(404);
        }
        if($shipping->shipping_by == "aramex") {
            $mo = (new \App\Shipping\Aramex)->getPdf($shipping->tracking_id);
            return redirect($mo->ShipmentLabel->LabelURL);
        } elseif($shipping->shipping_by == "smsa") {
            $mo = (new \App\Shipping\Smsa)->getPdf($shipping->tracking_id);
            return $mo["pdf"];
        } else {
            return view('e-commerce.pages.CheckOut.spol_document',["shipping"=>$shipping]);
        }
    }

}
