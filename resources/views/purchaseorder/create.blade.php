@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong><i class="fa-solid fa-triangle-exclamation me-2"></i>Oops! Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('purchaseOrder.store') }}" method="POST" id="poForm">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h2 class="fw-bold mb-1 text-dark">Create Purchase Order</h2>
                        <p class="text-muted small">Generate a new order to replenish warehouse stock.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light border px-4" onclick="window.history.back()">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="bi bi-file-earmark-check me-2"></i> Save Purchase Order
                        </button>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="glass-panel border-0 shadow-sm p-4 h-100">
                            <h5 class="fw-bold mb-4">Order Details</h5>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                                    <option value="">Select a vendor</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Expected Date</label>
                                <input type="date" name="ordered_at" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                            </div>

                            <div class="mb-0">
                                <label class="form-label fw-semibold">Internal Notes</label>
                                <textarea name="notes" rows="4" class="form-control" placeholder="Optional delivery instructions..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="glass-panel border-0 shadow-sm p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0">Order Items</h5>
                                <button type="button" class="btn btn-sm btn-soft-primary fw-bold" onclick="addRow()">
                                    <i class="bi bi-plus-circle me-1"></i> Add Product
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table align-middle" id="itemsTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 45%">Product</th>
                                            <th style="width: 20%">Quantity</th>
                                            <th style="width: 25%">Unit Price ($)</th>
                                            <th style="width: 10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="poItemsBody">
                                        <tr class="item-row">
                                            <td>
                                                <select name="items[0][product_id]" class="form-select border-0 bg-light" required>
                                                    <option value="">Choose...</option>
                                                    @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="items[0][quantity]" class="form-control border-0 bg-light" min="1" value="1" required>
                                            </td>
                                            <td>
                                                <input type="number" name="items[0][price]" step="0.01" class="form-control border-0 bg-light" placeholder="0.00" required>
                                            </td>
                                            <td class="text-end">
                                                <button type="button" class="btn btn-link text-danger p-0" onclick="removeRow(this)">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                <span class="text-muted small">Ensure all unit prices match the supplier's latest quote.</span>
                                <div class="text-end">
                                    <span class="text-muted small me-2">Estimated Total:</span>
                                    <span class="h5 fw-bold mb-0" id="grandTotal">$0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    let rowIdx = 1;

    function addRow() {
        const tbody = document.getElementById('poItemsBody');
        const newRow = document.createElement('tr');
        newRow.className = 'item-row';
        newRow.innerHTML = `
            <td>
                <select name="items[${rowIdx}][product_id]" class="form-select border-0 bg-light" required>
                    <option value="">Choose...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[${rowIdx}][quantity]" class="form-control border-0 bg-light" min="1" value="1" required>
            </td>
            <td>
                <input type="number" name="items[${rowIdx}][price]" step="0.01" class="form-control border-0 bg-light" placeholder="0.00" required>
            </td>
            <td class="text-end">
                <button type="button" class="btn btn-link text-danger p-0" onclick="removeRow(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
        rowIdx++;
    }

    function removeRow(btn) {
        const rows = document.querySelectorAll('.item-row');
        if (rows.length > 1) {
            btn.closest('tr').remove();
        } else {
            alert("At least one item is required.");
        }
    }
</script>

<style>
    .btn-soft-primary {
        background: #eef2ff;
        color: #4f46e5;
        border: 1px solid #e0e7ff;
    }

    .btn-soft-primary:hover {
        background: #4f46e5;
        color: white;
    }

    input[type="number"]::-webkit-inner-spin-button {
        display: none;
    }
</style>
@endsection