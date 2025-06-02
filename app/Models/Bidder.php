<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    protected $fillable = [
        'category_id',
        'ma_dau_thau',
        'ma_phan',
        'ten_phan',
        'product_name',
        'thong_so_moi_thau',
        'unit',
        'uoc_tinh_phan_lo',
        'gia_kh',
        'yeu_cau_ve_xuat_xu',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryBidder::class, 'category_id', 'code');
    }

    public function group()
    {
        return $this->belongsTo(GroupBidder::class, 'ma_dau_thau', 'id');
    }
}
