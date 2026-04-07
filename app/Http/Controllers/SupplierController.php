<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected SupplierService $service;
    public function __construct(SupplierService $supplierservice)
    {
        $this->service = $supplierservice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
     $this->service->createSupplier($request->validated(),$request->user());
     return redirect()->route('supplier.index')->with('success', 'Supplier Created Successfuly');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return  view('supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request,Supplier $supplier)
    {
        $this->service->updateSupplier($request->validated(),$supplier);
        return redirect()->route('supplier.index')->with('success','Suppier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $this->service->deleteSupplier($supplier);
        return redirect()->route('supplier.index')->with('success','Supplier Deleted Successfully');
    }
}
