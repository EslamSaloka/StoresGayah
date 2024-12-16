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
        Schema::create('e_clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->integer('otp')->nullable();
            $table->boolean('suspend')->default(0);
            $table->string('avatar')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('e_clients');
    }
};
