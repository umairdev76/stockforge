<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'supplier_id',
        'status',
        'total_amount',
        'ordered_at',
        'received_at',
        'created_by'
    ];
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function purchaseOrderItem(){
        return $this->hasMany(PurchaseOrderItem::class,'purchase_order_id');
    }
}
