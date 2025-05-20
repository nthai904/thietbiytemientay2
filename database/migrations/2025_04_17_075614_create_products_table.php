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
            $table->string('ky_ma_hieu', 100)->unique()->nullable();
            $table->string('nhan_hieu')->nullable();
            $table->text('thong_so_ky_thuat_co_ban')->nullable();
            $table->text('thong_so_ky_thuat_thau')->nullable();
            $table->string('hang_sx', 150)->nullable();
            $table->string('nuoc_sx', 100)->nullable();
            $table->string('hang_nuoc_chu_so_huu')->nullable();
            $table->string('quy_cach')->nullable();
            $table->string('don_vi_tinh')->nullable();
            $table->date('hsd')->nullable();
            $table->double('gia_von', 15, 2)->nullable();
            $table->double('gia_de_xuat', 15, 2)->nullable();
            $table->string('ten_ncc')->nullable();
            $table->string('ma_vtyt')->nullable();
            $table->string('nhom_theo_tt')->nullable();
            $table->string('phan_loai_ttbyt')->nullable();
            $table->string('so_dang_ky_luu_hanh')->nullable();
            $table->string('so_bang_phan_loai')->nullable();
            $table->text('ghi_chu')->nullable();
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
