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
        Schema::create('e_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            // +++++++++++++++++++++++ //
            $table->float('sub_total')->default(0);
            $table->float('vat_price')->default(0);
            // +++++++++++++++++++++++ //
            $table->string('shipping_id')->nullable();
            $table->string('shipping_by')->nullable();
            $table->float('shipping_price')->default(0);
            $table->float('coupon_price')->default(0);
            $table->float('cod_fees')->default(0);
            // +++++++++++++++++++++++ //
            $table->longText('note')->nullable();
            // +++++++++++++++++++++++ //
            $table->float('total')->default(0);
            // +++++++++++++++++++++++ //
            $table->string('payment_type')->default("visa");
            $table->string('payment_status')->default("paid");
            $table->string('status')->default("new");
            $table->string('image')->nullable();
            // +++++++++++++++++++++++ //
            $table->string('tracking_id')->nullable();
            // +++++++++++++++++++++++ //
            $table->string('payment_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            // ============================ //
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('e_clients')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('e_coupons')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('e_address')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->float('price')->default(0);
            $table->float('qty')->default(0);
            $table->float('total')->default(0);
            // +++++++++++++++++++++++ //
            $table->timestamps();
            // ============================ //
            $table->foreign('order_id')->references('id')->on('e_orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            // ============================ //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_order_items');
        Schema::dropIfExists('e_orders');
    }
};
