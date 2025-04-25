<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bidder extends Model
{
    protected $fillable = [
        'category_id',
        'ma_phan',
        'ten_phan',
        'product_name',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryBidder::class, 'category_id', 'code');
    }

    
}
