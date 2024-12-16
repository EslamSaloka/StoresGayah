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
        Schema::create('e_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("image")->nullable();
            $table->unsignedBigInteger("parent_id")->nullable()->index();
            $table->timestamps();
            // ============================ //
            $table->unsignedBigInteger('store_id')->index();
            $table->foreign('store_id')->references('id')->on('users')->onDelete('cascade');
            // ============================ //
            $table->foreign('parent_id')->references('id')->on('e_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_categories');
    }
};
