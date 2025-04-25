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
            $table->double('price', 15, 8)->change();
            $table->double('total_price', 15, 8)->change();

            $table->string('code_category_bidder')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->dropColumn('code_category_bidder');
        });
    }
};
