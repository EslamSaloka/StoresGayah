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
        Schema::create('e_settings', function (Blueprint $table) {
            $table->id();
            $table->string("key")->nullable();
            $table->longText("value")->nullable();
            $table->string("group_by")->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('e_settings');
    }
};
