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
            $table->string('id_product')->nullable();
            $table->string('extra_price')->nullable();
            $table->string('product_name_bidder')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->dropColumn('id_product');
            $table->dropColumn('extra_price');
            $table->dropColumn('product_name_bidder');
        });
    }
};
