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
            $table->string('ma_phan');
            $table->string('ten_phan');
            $table->string('unit');
            $table->integer('quantity');
            $table->string('product_name');
            $table->string('quy_cach');
            $table->string('brand');
            $table->string('country');
            $table->decimal('price');
            $table->decimal('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding_doccument');
    }
};
