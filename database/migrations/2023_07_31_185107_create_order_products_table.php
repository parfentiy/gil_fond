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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('price', 12);
            $table->timestamps();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->index('order_id', 'order_product_order_idx');
            $table->foreign('order_id', 'order_product_order_fk')
                ->on('orders')->references('id');

            $table->unsignedBigInteger('product_id')->nullable();
            $table->index('product_id', 'order_product_product_idx');
            $table->foreign('product_id', 'order_product_product_fk')
                ->on('products')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
