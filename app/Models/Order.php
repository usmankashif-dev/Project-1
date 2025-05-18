<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'mall_id',
        'quantity',
        'rem',
        'machine',
        'peice',
        'lenght',
        'widht',
        'gauge',
        'dateno',
    ];

    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }
}
