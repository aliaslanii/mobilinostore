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
        Schema::create('berands', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->text('Description')->nullable();
            $table->integer('favorite')->default(0);
            $table->boolean('is_show')->default(0);
            $table->string('img');
            $table->boolean('is_Delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berands');
    }
};
