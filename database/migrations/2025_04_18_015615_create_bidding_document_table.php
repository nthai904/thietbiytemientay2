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
        Schema::create('bidding_document', function (Blueprint $table) {
            $table->id();
            $table->string('ma_phan')->nullable();
            $table->string('ten_phan')->nullable();
            $table->string('unit')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('product_name')->nullable();
            $table->string('quy_cach')->nullable();
            $table->string('brand')->nullable();
            $table->string('country')->nullable();
            $table->double('price')->nullable();
            $table->double('total_price')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding_document');
    }
};
