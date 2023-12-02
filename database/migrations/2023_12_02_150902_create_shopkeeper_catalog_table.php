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
        Schema::create('shopkeeper_catalog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shopkeeper_id');
            $table->string('catalog_photo', 255);
            $table->string('catalog_text', 255);
            $table->timestamps();
            $table->foreign('shopkeeper_id')->references('id')->on('shopkeeper')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopkeeper_catalog');
    }
};
