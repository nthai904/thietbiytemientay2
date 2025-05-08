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
    ];

    public function bidder()
    {
        return $this->belongsTo(Bidder::class, 'code_category_bidder', 'category_id');
    }

    public function category(){
        return $this->belongsTo(CategoryBidder::class, 'code_category_bidder', 'code');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'id_product', 'code');
    }

    public function group() {
        return $this->belongsTo(GroupBidder::class, 'group_id', 'id');
    }
}
