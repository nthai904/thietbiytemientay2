<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'ky_ma_hieu',
        'nhan_hieu',
        'thong_so_ky_thuat_co_ban',
        'thong_so_ky_thuat_thau',
        'hang_sx',
        'nuoc_sx',
        'hang_nuoc_chu_so_huu',
        'quy_cach',
        'don_vi_tinh',
        'hsd',
        'gia_von',
        'gia_de_xuat',
        'ten_ncc',
        'ma_vtyt',
        'nhom_theo_tt',
        'phan_loai_ttbyt',
        'so_dang_ky_luu_hanh',
        'so_bang_phan_loai',
        'ghi_chu',
    ];
}
