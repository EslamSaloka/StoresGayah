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
        Schema::create('e_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            // +++++++++++++++++++++++ //
            $table->float("price")->default(0);
            $table->float("offer")->default(0);
            // +++++++++++++++++++++++ //
            $table->float("rate")->default(0);
            // +++++++++++++++++++++++ //
            $table->float("qty")->default(0);
            $table->float("length")->default(0);
            $table->float("width")->default(0);
            $table->float("weight")->default(0);
            // +++++++++++++++++++++++ //
            $table->boolean("star")->default(0);
            $table->boolean("public")->default(1);
            // +++++++++++++++++++++++ //
            $table->timestamps();
            // ============================ //
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->string("image")->nullable();
            // ============================ //
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_product_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->integer("rate")->nullable();
            $table->longText("message")->nullable();
            $table->timestamps();
            // ============================ //
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('e_clients')->onDelete('cascade');
            // ============================ //
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_product_categories_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();
            // ============================ //
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('e_categories')->onDelete('cascade');
            // ============================ //
        });

        Schema::create('e_product_fav', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->timestamps();
            // ============================ //
            $table->foreign('product_id')->references('id')->on('e_products')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('e_clients')->onDelete('cascade');
            // ============================ //
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_product_fav');
        Schema::dropIfExists('e_product_rates');
        Schema::dropIfExists('e_product_categories_pivot');
        Schema::dropIfExists('e_product_images');
        Schema::dropIfExists('e_products');
    }
};
