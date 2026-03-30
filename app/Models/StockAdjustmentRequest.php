<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustmentRequest extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'requested_quantity',
        'reason',
        'status',
    ];
}
