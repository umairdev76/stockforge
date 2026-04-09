<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderRequest;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Services\ProductService;
use App\Services\PurchaseOrderService;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    protected PurchaseOrderService $service;
    public function __construct(PurchaseOrderService $purchaseOrderService)
    {
        $this->service = $purchaseOrderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('purchaseOrder.index',compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchaseOrder.create',compact('suppliers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseOrderRequest $request)
    {
        $this->service->CreatePurchaseOrder($request->validated(),$request->user());
        return redirect()->route('purchaseOrder.index')->with('success','Purchase Order Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $po)
    {
        $po->load(['supplier', 'purchaseOrderItem.product']);
        return view('purchaseOrder.show',compact('po'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
