<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [
            'name',
            'code',
            'tag',
            'year',
            'country',
            'brand',
            'detail',
            'category',
            'price',
            'unit',
            'quy_cach'
        ];
}
