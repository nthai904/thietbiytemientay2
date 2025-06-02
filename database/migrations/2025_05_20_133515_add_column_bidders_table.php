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
        Schema::table('bidders', function (Blueprint $table) {
            $table->string('thong_so_moi_thau')->nullable()->after('product_name');
            $table->string('unit')->nullable()->after('thong_so_moi_thau');
            $table->string('uoc_tinh_phan_lo')->nullable()->after('unit');
            $table->string('gia_kh')->nullable()->after('uoc_tinh_phan_lo');
            $table->string('yeu_cau_ve_xuat_xu')->nullable()->after('gia_kh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bidders', function (Blueprint $table) {
            Schema::table('bidders', function (Blueprint $table) {
                $table->dropColumn([
                    'thong_so_moi_thau',
                    'unit',
                    'uoc_tinh_phan_lo',
                    'gia_kh',
                    'yeu_cau_ve_xuat_xu'
                ]);
            });
        });
    }
};
