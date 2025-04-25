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
            $table->string('name', 255)->nullable();
            $table->string('code', 100)->unique()->nullable(); 
            $table->string('tag')->nullable();
            $table->year('year')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('brand', 150)->nullable();
            $table->text('detail')->nullable();
            $table->string('category', 255)->nullable();
            $table->decimal('price', 15, 2)->default(0)->nullable();
            $table->string('unit', 50)->default('cái')->nullable();
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
