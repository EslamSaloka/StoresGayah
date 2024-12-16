<?php

namespace App\Http\Controllers\ECommerce\Products;

use App\Http\Controllers\ECommerce\ECommerceController;
use App\Http\Requests\Ecommerce\Comment\CommentStore;
use App\Models\Product;
use App\Models\Product\Fav;
use App\Models\Product\Rate;
use Illuminate\Support\Facades\Auth;

class ProductsController extends ECommerceController
{
    public function index() {
        $products = Product::Tenancy();
        if(request()->has("name") && request("name") != '') {
            $products = $products->where("name","like","%".request("name")."%");
        }
        if(request()->has("category_id") && request("category_id") != '0') {
            $products = $products->whereHas("categories",function($q){
                return $q->where("category_id",request("category_id"));
            });
        }
        if(request()->has("sub_id") && request("sub_id") != '0') {
            $su = explode(",",request("sub_id",0));
            $products = $products->whereHas("categories",function($q)use($su) {
                return $q->whereIn("category_id",$su);
            });
        }
        if(request()->has('price')) {
            $products = $products->orderBy("price",request('price'))->paginate();
        } else {
            $products = $products->latest()->paginate();
        }
        return view("e-commerce.pages.Products.index",get_defined_vars());
    }

    public function show($domain_name,Product $product) {
        $categories = $product->categories()->pluck("category_id")->toArray();
        $products = Product::Tenancy();
        $products = $products->whereHas("categories",function($q)use($categories){
            return $q->whereIn("e_categories.id",$categories);
        });

        $products = $products->where('id',"!=",$product->id)->take(4)->get();
        return view("e-commerce.pages.Products.show",get_defined_vars());
    }

    public function action($domain_name,$action_name,$product_id) {
        $status     = 1;
        $message    = '';
        $html       = '';
        $red        = '';
        $remove     = 0;
        if($action_name == "fav") {
            if(Auth::check()) {
                $fav = Fav::where("product_id",$product_id)->where("client_id",Auth::user()->id)->first();
                if(!is_null($fav)) {
                    $fav->delete();
                    $message = "تم حذف المنتج من المفضلة";
                    $remove = 1;
                    $red = "1";
                } else {
                    Fav::create(["product_id"=>$product_id,"client_id"=>Auth::user()->id]);
                    $message = "تم إضافه المنتج للمفضلة";
                    $red = "1";
                }
            } else {
                $status  = 0;
                $message = "برجاء تسجيل الدخول اولا";
            }
        } elseif($action_name == "cart") {
            if(Auth::check()) {
                $product = Product::find($product_id);
                (new \App\Support\Cart)->setItem($product,1);
                $message = "تم إضافة المنتج في سلة الشراء";
                $red = "1";
            } else {
                $status = 0;
                $message = "برجاء تسجيل الدخول اولا";
            }
        } else {
            $product = Product::find($product_id);
            if(is_null($product)) {
                $status = 0;
                $message = "هذا المنتج غير متوفر لدينا حاليا";
            } else {
                $html = view("e-commerce.pages.Products.modal",["product"=>$product])->render();
            }
        }

        return [
            "status"    => $status,
            "message"   => $message,
            "html"      => $html,
            "red"       => $red,
            "remove"    => $remove,
        ];
    }

    public function commentStore(CommentStore $request,$domain_name,Product $product) {
        $request = $request->validated();
        $request['product_id'] = $product->id;
        // ============================== //
        $check = Rate::where([
            'product_id' => $product->id,
            'client_id'     => Auth::user()->id,
        ])->first();
        if(!is_null($check)) {
            return [
                "status"    => 0,
                "title"     => 'تنبية',
                "button"    => 'إغلاق',
                "message"   => "لقد قمت بتقيم هذا المنتج من قبل",
                "redirect"  => 0,
                "resetInput" => 0,
            ];
        }
        // ============================== //
        Rate::create($request);
        // ===================== //
        $sum   = $product->rates()->sum('rate');
        $count = $product->rates()->count();
        $product->update(["rate"=>($sum / $count)]);
        // ===================== //

        return [
            "status"    => 1,
            "title"     => 'شكرا لك',
            "button"    => 'إغلاق',
            "message"   => "تم تقديم تقييمك للمنتج بنجاح",
            "redirect"  => 0,
            "resetInput" => 1,
        ];
    }
}
