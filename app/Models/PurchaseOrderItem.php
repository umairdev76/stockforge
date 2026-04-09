<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $table = 'purchase_orders_items';
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'unit_price'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function purchaseOrder(){
        return $this->belongsTo(PurchaseOrder::class,'purchase_order_id');
    }

}
