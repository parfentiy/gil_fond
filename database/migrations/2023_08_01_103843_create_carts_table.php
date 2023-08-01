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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->index('user_id', 'cart_user_idx');
            $table->foreign('user_id', 'cart_user_fk')
                ->on('users')->references('id');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->index('product_id', 'cart_product_idx');
            $table->foreign('product_id', 'cart_product_fk')
                ->on('products')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
