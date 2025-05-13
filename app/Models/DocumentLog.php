<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    protected $table = 'document_logs';

    protected $fillable = [
        'document_id',
        'group_id',
        'so_luong_da_giao',
        'so_luong_con_lai',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }
}
