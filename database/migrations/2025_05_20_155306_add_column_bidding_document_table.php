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
            $table->text('thong_so_ky_thuat_co_ban')->nullable()->after('country');
            $table->text('thong_so_ky_thuat_thau')->nullable()->after('thong_so_ky_thuat_co_ban');
            $table->string('hang_nuoc_chu_so_huu')->nullable()->after('thong_so_ky_thuat_thau');
            $table->date('hsd')->nullable()->after('hang_nuoc_chu_so_huu');
            $table->string('ten_ncc')->nullable()->after('hsd');
            $table->string('ma_vtyt')->nullable()->after('ten_ncc');
            $table->string('nhom_theo_tt')->nullable()->after('ma_vtyt');
            $table->string('phan_loai_ttbyt')->nullable()->after('nhom_theo_tt');
            $table->string('so_dang_ky_luu_hanh')->nullable()->after('phan_loai_ttbyt');
            $table->string('so_bang_phan_loai')->nullable()->after('so_dang_ky_luu_hanh');
            $table->text('ghi_chu')->nullable()->after('so_bang_phan_loai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidding_document', function (Blueprint $table) {
            $table->dropColumn('thong_so_ky_thuat_co_ban');
            $table->dropColumn('thong_so_ky_thuat_thau');
            $table->dropColumn('hang_nuoc_chu_so_huu');
            $table->dropColumn('hsd');
            $table->dropColumn('ten_ncc');
            $table->dropColumn('ma_vtyt');
            $table->dropColumn('nhom_theo_tt');
            $table->dropColumn('phan_loai_ttbyt');
            $table->dropColumn('so_dang_ky_luu_hanh');
            $table->dropColumn('so_bang_phan_loai');
            $table->dropColumn('ghi_chu');
        });
    }
};
