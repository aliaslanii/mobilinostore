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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('P_id')->nullable();
            $table->string('Name')->nullable();
            $table->string('title')->nullable();
            $table->string('img')->nullable();
            $table->integer('SumNumber')->nullable();
            $table->text('Description')->nullable();
            $table->integer('favorite')->default(0);
            $table->string('send')->nullable();
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->unsignedBigInteger('berand_id')->nullable();
            $table->foreign('berand_id')->references('id')->on('berands');
            $table->unsignedBigInteger('discounts_id')->nullable();
            $table->foreign('discounts_id')->references('id')->on('discounts');
            $table->unsignedBigInteger('suggestions_id')->nullable();
            $table->foreign('suggestions_id')->references('id')->on('suggestions');
            $table->boolean('is_Delete')->default(0);
            $table->boolean('Show')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
