<?php

namespace App\Http\Controllers\ECommerce\CheckOut;

use App\Http\Controllers\ECommerce\ECommerceController;
use Illuminate\Http\Request;
use App\Http\Requests\Ecommerce\CheckOut\CheckOutRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOutController extends ECommerceController
{
    public function index() {
         $cart = Cart::Tenancy()->where('client_id',Auth::user()->id)->first();
        if(is_null($cart)) {
            return redirect(makeRoute('home'));
        }
        if(is_null($cart->shipping_by)) {
            return redirect(makeRoute('cart.index'));
        }
        if($cart->items()->count() == 0) {
            $cart->delete();
            return redirect(makeRoute('home'));
        }
        return view("e-commerce.pages.CheckOut.index");
    }

    public function store(CheckOutRequest $request) {
        $cart = (new \App\Support\Cart)->getCart();
        if(is_null($cart)) {
            return redirect(makeRoute('home'));
        }
        $order = Order::create([
            "address_id"        => $request->address_id,
            "payment_type"      => $request->payment_type,
            "payment_status"    => 'unpaid',
            "note"              => $request->note ?? '',
            "cod_price"         => ($request->payment_type == "cod") ? 10 : 0
        ]);
        $items = (new \App\Support\Cart)->getCart()->items->toArray();
        foreach($items as $item) {
            \App\Models\Order\Item::create([
                'order_id'      => $order->id,
                'product_id'    => $item["product_id"],
                'qty'           => $item["qty"],
                'price'         => $item["price"],
                'total'         => $item["total"],
            ]);
        }
        if($order->payment_type == "visa") {
            $payment    = (new \App\Payment\Payment)->payNow($order);
            if($payment["status"] == false) {
                $order->delete();
                return redirect(makeRoute('check-out.orderCompleted'))->with('danger', __("حدث خطأ ما برجاء إعاده المحاولة"));
            }
            $order->update([
                "payment_id"  => $payment['invoiceId']
            ]);
            (new \App\Support\Cart)->getCart()->delete();
            Session::put("ORDER_ID",$order->id);
            return redirect($payment["InvoiceURL"]);
        } else {
            (new \App\Support\Cart)->getCart()->delete();
            Session::put("ORDER_ID",$order->id);
            return redirect(makeRoute('check-out.orderCompleted'));
        }
    }

    public function orderCompleted() {
        if(!Session::get("ORDER_ID")) {
            return redirect(makeRoute('home'));
        }
        $ID = Session::get("ORDER_ID");
        Session::forget("ORDER_ID");
        return view("e-commerce.pages.CheckOut.complete",["ID"=>$ID]);
    }

    public function callBackPlans(Request $request) {
        if(!request()->has("paymentId")) {
            return redirect(makeRoute('check-out.orderCompleted'))->with("danger", __("رقم الفاتوره مطلوب"));
        }
        $pay = (new \App\Payment\Payment)->callBack($request->paymentId);

        $order = Order::where(["payment_id"=>$pay["Data"]["InvoiceId"]])->first();
        if(is_null($order)) {
            return redirect(makeRoute('check-out.orderCompleted'))->with("danger", __("هذا الطلب غير متوفر لدينا"));
        }

        if($pay["Data"]["InvoiceTransactions"][0]["TransactionStatus"] == "Succss") {
            $order->update([
                "payment_status"    => "paid",
                "transaction_id"     => $request->paymentId,
            ]);
            return redirect(makeRoute('check-out.orderCompleted'))->with("success", __("عملية دفع ناجحة"));

        } else if($pay["Data"]["InvoiceTransactions"][0]["TransactionStatus"] == "Failed") {
            $order->update([
                "payment_status"    => "unpaid",
                "transaction_id"     => $request->paymentId,
            ]);
            return redirect(makeRoute('home'))->with("danger", __("عملية دفع فاشلة حاول مرة اخرى"));
        } else if($pay["Data"]["InvoiceTransactions"][0]["TransactionStatus"] == "InProgress") {
            $order->update([
                "payment_status"    => "in_process",
                "response_code"     => "001",
                "transaction_id"     => $request->paymentId,
            ]);
            return redirect(makeRoute('home'))->with("danger", __("جاري مراجعة طلبك من قبل بوابه الدفع"));
        }

    }

}
