@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <a href="{{ route('purchaseOrder.index') }}" class="text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Back to Orders
            </a>
            <h2 class="fw-bold mt-2">Order #{{ str_pad($po->id, 5, '0', STR_PAD_LEFT) }}</h2>
        </div>

        <div class="d-flex gap-2">
            <a href="" class="btn btn-outline-dark">
                <i class="bi bi-file-pdf me-2"></i> Download PDF
            </a>

            @if($po->status === 'Pending')
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-success px-4 shadow-sm" onclick="return confirm('Confirm receipt? This will update stock levels.')">
                    <i class="bi bi-box-seam me-2"></i> Mark as Received
                </button>
            </form>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="glass-panel border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-4">Vendor & Delivery</h5>
                <label class="small text-muted text-uppercase fw-bold">Supplier</label>
                <p class="fw-bold mb-3 h5 text-primary">{{ $po->supplier?->name ?? 'Unknown supplier' }}</p>

                <label class="small text-muted text-uppercase fw-bold">Expected On</label>
                <p class="mb-3">{{ \Carbon\Carbon::parse($po->ordered_at)->format('F d, Y') }}</p>

                <label class="small text-muted text-uppercase fw-bold">Order Notes</label>
                <p class="small text-dark">{{ $po->notes ?: 'No special instructions.' }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="glass-panel border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">Ordered Items</h5>
                <table class="table align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($po->purchaseOrderItem as $item)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $item->product->name }}</div>
                                <code class="small text-primary">{{ $item->product->sku }}</code>
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                            <td class="text-end fw-bold h5 text-primary">${{ number_format($po->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
