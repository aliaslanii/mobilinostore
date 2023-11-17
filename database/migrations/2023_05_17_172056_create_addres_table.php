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
        Schema::create('addres', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Phone')->nullable();
            $table->string('Mobile');   
            $table->text('Address');
            $table->unsignedBigInteger('states_id');
            $table->foreign('states_id')->references('id')->on('states');
            $table->unsignedBigInteger('cities_id');
            $table->foreign('cities_id')->references('id')->on('cities'); 
            $table->string('ZipCode'); 
            $table->string('Plate'); 
            $table->string('Unit')->nullable();        
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_Delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addres');
    }
};
