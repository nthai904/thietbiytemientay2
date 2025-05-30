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
            $table->string('group_id')->after('code_category_bidder')->nullable();
            $table->integer('so_luong_da_giao')->after('quantity')->nullable();
            $table->integer('so_luong_con_lai')->after('so_luong_da_giao')->nullable();
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->dropColumn('status');
        });
    }
};
