<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact_email',
        'phone',
        'address',
        'created_by'
    ];
    public function users(){
        return $this->belongsTo(User::class,'created_by');
    }
    public function products(){
        return $this->hasMany(Product::class,'supplier_id');
    }
    public function purchaseOrder(){
        return $this->hasMany(PurchaseOrder::class,'supplier_id');
    }
}
