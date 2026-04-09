<?php

namespace App\Services;

use App\Models\PurchaseOrderItem;
use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchaseOrderService
{
    public function __construct()
    {
        // 
    }
    public function CreatePurchaseOrder(array $data, User $user){
        return DB::transaction(function () use ($data, $user) {
            $items = $data['items'] ?? [];

            $totalAmount = 0;
            foreach ($items as $item) {
                $qty = (int) $item['quantity'];
                $price = (float) $item['price'];
                $totalAmount += $qty * $price;
            }

            $purchaseOrder = PurchaseOrder::create([
                'supplier_id' => $data['supplier_id'],
                'status' => $data['status'] ?? 'pending',
                'total_amount' => $totalAmount,
                'ordered_at' => date('Y-m-d', strtotime($data['ordered_at'])),
                'received_at' => $data['received_at'] ?? null,
                'created_by' => $user->id,
            ]);

            foreach ($items as $item) {
                PurchaseOrderItem::create([
                    'purchase_order_id' => $purchaseOrder->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            return $purchaseOrder;
        });
    }
}
