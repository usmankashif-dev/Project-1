<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'mall_id',
        'orderedqty',
        'olenght',
        'ogauge',
        'peice',
        'lenght',
        'widht',
        'gauge',
        'dateno',
        'lot',
        'rem',
        'orgsheet',
        'cutsheet',
        'bundlewidht',
        'sheetperbundle',
        'partyorder',
        'cutsheetqty',
        'jalilenght',
    ];

    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }
}
