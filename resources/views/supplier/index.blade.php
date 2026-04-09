@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">Suppliers</h2>
            <p class="text-muted small">Manage your vendor relationships and contact details.</p>
        </div>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-truck me-2"></i> Add New Supplier
        </a>
    </div>

    <div class="glass-panel border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold small text-uppercase">Supplier Name</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Contact Email</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Phone</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Address</th>
                        <th class="pe-4 py-3 text-muted fw-semibold small text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $supplier->name }}</div>
                            <small class="text-muted">Added: {{ $supplier->created_at->format('M d, Y') }}</small>
                        </td>
                        <td>
                            <a href="mailto:{{ $supplier->contact_email }}" class="text-decoration-none">
                                <i class="bi bi-envelope me-1"></i> {{ $supplier->contact_email }}
                            </a>
                        </td>
                        <td><span class="text-muted">{{ $supplier->phone ?? 'N/A' }}</span></td>
                        <td>
                            <span class="text-muted small" title="{{ $supplier->address }}">
                                {{ Str::limit($supplier->address, 30) }}
                            </span>
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="" class="btn btn-sm btn-light border" title="View Details">
                                    <i class="bi bi-eye text-success"></i>
                                </a>
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border" onclick="return confirm('Delete this supplier?')" title="Delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection