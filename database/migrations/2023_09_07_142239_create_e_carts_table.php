<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            // +++++++++++++++++++++++ //
            $table->float('sub_total')->default(0);
            $table->float('vat_price')->default(0);
            // +++++++++++++++++++++++ //
            $table->string('shipping_by')->nullable();
            $table->float('shipping_price')->default(0);
            $table->float('coupon_price')->default(0);
            // +++++++++++++++++++++++ //
            $table->longText('note')->nullable();
            // +++++++++++++++++++++++ //
            $table->float('total')->default(0);
            $table->timestamps();
            // ============================ //
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('e_clients')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('e_coupons')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('e_address')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->float('price')->default(0);
            $table->float('qty')->default(0);
            $table->float('total')->default(0);
            // +++++++++++++++++++++++ //
            $table->timestamps();
            // ============================ //
            $table->foreign('cart_id')->references('id')->on('e_carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            // ============================ //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_cart_items');
        Schema::dropIfExists('e_carts');
    }
};