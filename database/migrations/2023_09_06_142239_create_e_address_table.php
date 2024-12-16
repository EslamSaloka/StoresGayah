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
        Schema::create('e_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->index();
            $table->string('shipping_by')->nullable();
            $table->string('title')->nullable();
            $table->string('city')->nullable();
            $table->longText('address')->nullable();
            $table->string('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
            // ============================ //
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
            $table->foreign('client_id')->references('id')->on('e_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_address');
    }
};
