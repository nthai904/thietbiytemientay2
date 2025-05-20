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
        Schema::table('group_bidder', function (Blueprint $table) {
            $table->timestamp('ngay_dong_thau')->nullable()->after('category_id');
            $table->string('user_id')->nullable()->after('ngay_dong_thau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_bidder', function (Blueprint $table) {
            $table->dropColumn('ngay_dong_thau');
        });
    }
};
