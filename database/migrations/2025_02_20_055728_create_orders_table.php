<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {

            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('cart_id');
                $table->unsignedBigInteger('address_id');
                $table->string('amount');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('cart_id')->references('id')->on('carts');
                $table->foreign('address_id')->references('id')->on('address_entity');

            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
