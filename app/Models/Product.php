<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock_quantity',
        'min_stock_level',
        'category_id',
        'supplier_id',
        'image',
        'created_by'
    ];
    public function user(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function stockMovement(){
        return $this->hasMany(StockMovement::class,'product_id');
    }
    public function purchaseOrderItem(){
        return $this->hasMany(PurchaseOrderItem::class,'product_id');
    }
}
