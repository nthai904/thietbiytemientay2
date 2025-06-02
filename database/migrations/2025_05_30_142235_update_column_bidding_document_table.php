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
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->double('price')->nullable()->change();
            $table->double('total_price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->double('price')->nullable(false)->change();
            $table->double('total_price')->nullable(false)->change();
        });
    }
};
