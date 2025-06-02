<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'bidding_document';

    protected $fillable = [
        'ma_phan',
        'ten_phan',
        'code_category_bidder',
        'unit',
        'quantity',
        'product_name',
        'product_name_bidder',
        'id_product',
        'quy_cach',
        'brand',
        'country',
        'price',
        'extra_price',
        'total_price',
        'type',
        'status',
        'group_id',
        'so_luong_da_giao',
        'so_luong_con_lai',
        'thong_so_ky_thuat_co_ban',
        'thong_so_ky_thuat_thau',
        'hang_nuoc_chu_so_huu',
        'hsd',
        'ten_ncc',
        'ma_vtyt',
        'nhom_theo_tt',
        'phan_loai_ttbyt',
        'so_dang_ky_luu_hanh',
        'so_bang_phan_loai',
        'ghi_chu',
        'user_id',
        'created_at',
    ];

    public function bidder()
    {
        return $this->belongsTo(Bidder::class, 'code_category_bidder', 'category_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryBidder::class, 'code_category_bidder', 'code');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'ky_ma_hieu');
    }

    public function group()
    {
        return $this->belongsTo(GroupBidder::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
