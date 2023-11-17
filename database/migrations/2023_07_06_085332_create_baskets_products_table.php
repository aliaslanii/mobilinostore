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
        Schema::create('baskets_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('baskets_id');
            $table->foreign('baskets_id')->references('id')->on('baskets');
            $table->unsignedBigInteger('products_id');
            $table->foreign('products_id')->references('id')->on('products');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->integer('count'); 
            $table->boolean('is_Delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets_products');
    }
};
