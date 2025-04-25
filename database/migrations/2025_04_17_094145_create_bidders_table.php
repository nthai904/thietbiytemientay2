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
        Schema::create('bidders', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->string('ma_phan', 100)->nullable();
            $table->string('ten_phan', 255)->nullable();
            $table->string('product_name', 255)->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidders');
    }
};
