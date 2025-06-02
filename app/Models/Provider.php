<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = "providers";
    protected $fillable = [
        'name',
        'address',
        'represent',
        'phone1',
        'phone2',
        'email',
        'status',
        'note'
    ];
}
