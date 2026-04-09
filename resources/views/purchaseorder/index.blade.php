@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">Purchase Orders</h2>
            <p class="text-muted small">Track and manage incoming inventory shipments.</p>
        </div>
        <a href="{{ route('purchaseOrder.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Create Order
        </a>
    </div>

    <div class="glass-panel border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold small text-uppercase">Order ID</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Supplier</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Total Items</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Status</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Expected Date</th>
                        <th class="pe-4 py-3 text-muted fw-semibold small text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchaseOrders as $po)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ str_pad($po->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <div class="fw-medium">{{ $po->supplier->name }}</div>
                        </td>
                        <td>{{ $po->items_count }} Items</td>
                        <td>
                            @php
                            $statusClass = match($po->status) {
                            'Pending' => 'bg-warning-subtle text-warning border-warning-subtle',
                            'Received' => 'bg-success-subtle text-success border-success-subtle',
                            'Cancelled' => 'bg-secondary-subtle text-secondary border-secondary-subtle',
                            default => 'bg-light text-dark'
                            };
                            @endphp
                            <span class="badge border rounded-pill px-3 {{ $statusClass }}">
                                {{ $po->status }}
                            </span>
                        </td>
                        <td class="text-muted small">{{ \Carbon\Carbon::parse($po->ordered_at)->format('M d, Y') }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ route('purchaseOrder.show', $po->id) }}" class="btn btn-sm btn-light border">
                                <i class="bi bi-eye text-primary"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection