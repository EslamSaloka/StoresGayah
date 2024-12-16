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
        Schema::create('e_order_benefits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->index();
            $table->unsignedBigInteger('order_id')->index();
            $table->float('price')->default(0);
            $table->boolean('done')->default(0);
            // +++++++++++++++++++++++ //
            $table->timestamps();
            // ============================ //
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('e_orders')->onDelete('cascade');
            // ============================ //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_order_benefits');
    }
};
