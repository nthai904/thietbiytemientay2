<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupBidder extends Model
{
    protected $table = "group_bidder";

    protected $fillable = [
        'name',
        'category_id',
        'user_id',
        'ngay_dong_thau',
        'status',
        'bided'
    ];

    public function category(){
        return $this->belongsTo(CategoryBidder::class, 'category_id', 'code');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
