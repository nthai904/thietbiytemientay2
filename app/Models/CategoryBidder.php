<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBidder extends Model
{
    protected $table = 'category_bidder';

    protected $fillable = [
        'code',
        'name',
        'address',
        'phone',
        'fax',
        'tk',
        'tax_code',
        'represent',
        'gender',
        'position',
    ];
    
    public function bidder()
    {
        return $this->hasMany(Bidder::class, 'category_id', 'code');
    }
}
