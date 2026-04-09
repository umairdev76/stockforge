@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-decoration-none">Inventory</a></li>
                    <li class="breadcrumb-item active">{{ $product->sku }}</li>
                </ol>
            </nav>
            <h2 class="fw-bold text-dark">{{ $product->name }}</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-primary px-4">
                <i class="bi bi-pencil-square me-2"></i> Edit Product
            </a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Archive this product?')">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="glass-panel border-0 shadow-sm mb-4 text-center p-4">
                <img src="{{ asset('storage/products/' . $product->image) }}"
                    class="img-fluid rounded-4 shadow-sm mb-4 border"
                    style="max-height: 300px; width: 100%; object-fit: cover;"
                    onerror="this.src='https://placehold.co/600x400/f1f5f9/64748b?text=No+Image'">

                <div class="d-flex justify-content-around border-top pt-4">
                    <div class="text-center">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Stock Level</small>
                        <h4 class="fw-bold mt-1 {{ $product->stock_quantity <= $product->min_stock_level ? 'text-danger' : 'text-success' }}">
                            {{ $product->stock_quantity }}
                        </h4>
                    </div>
                    <div class="text-center border-start ps-4">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Unit Price</small>
                        <h4 class="fw-bold mt-1 text-dark">${{ number_format($product->price, 2) }}</h4>
                    </div>
                </div>
            </div>

            <div class="glass-panel border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-3">Supplier Information</h5>
                <div class="d-flex align-items-center mb-3">
                    <div class="btn btn-soft-primary rounded-circle me-3"><i class="bi bi-building"></i></div>
                    <div>
                        <div class="fw-bold">{{ $product->supplier->name }}</div>
                        <small class="text-muted">Primary Vendor</small>
                    </div>
                </div>
                <a href="mailto:{{ $product->supplier->contact_email }}" class="btn btn-light w-100 border text-start mb-2">
                    <i class="bi bi-envelope me-2"></i> {{ $product->supplier->contact_email }}
                </a>
                <div class="btn btn-light w-100 border text-start">
                    <i class="bi bi-telephone me-2"></i> {{ $product->supplier->phone ?? 'N/A' }}
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="glass-panel border-0 shadow-sm p-4 mb-4">
                <ul class="nav nav-tabs nav-tabs-custom mb-4" id="productTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold px-4 border-0" data-bs-toggle="tab" data-bs-target="#info">Overview</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold px-4 border-0" data-bs-toggle="tab" data-bs-target="#history">Movement History</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="info">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted text-uppercase fw-bold">SKU Reference</label>
                                <p class="h5 fw-medium">{{ $product->sku }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Category</label>
                                <p><span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 rounded-pill h6">{{ $product->category->name }}</span></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Minimum Threshold</label>
                                <p class="h5 fw-medium">{{ $product->min_stock_level }} Units</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted text-uppercase fw-bold">Date Registered</label>
                                <p class="h5 fw-medium">{{ $product->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <label class="small text-muted text-uppercase fw-bold">Product Description</label>
                        <p class="text-dark leading-relaxed">
                            {{ $product->description ?: 'No description provided for this item.' }}
                        </p>
                    </div>

                    <div class="tab-pane fade" id="history">
                        <table class="table table-sm align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="py-2">Date</th>
                                    <th>Ty pe</th>
                                    <th>Quantity</th>
                                    <th>Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($product->stockMovements && $product->stockMovements->count() > 0)
                                @foreach($product->stockMovements as $move)
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">No recent stock movements recorded.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="p-4 bg-primary text-white rounded-4 shadow-sm">
                        <h5 class="fw-bold">New Stock In</h5>
                        <p class="small opacity-75">Increase inventory levels manually or via Purchase Order.</p>
                        <button class="btn btn-white btn-sm fw-bold px-3 shadow-none">Receive Items</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-dark text-white rounded-4 shadow-sm">
                        <h5 class="fw-bold">Stock Out / Sale</h5>
                        <p class="small opacity-75">Decrease inventory levels for orders or damage adjustments.</p>
                        <button class="btn btn-outline-light btn-sm fw-bold px-3">Adjust Stock</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs-custom .nav-link {
        color: #64748b;
        margin-bottom: -1px;
    }

    .nav-tabs-custom .nav-link.active {
        color: #4f46e5;
        border-bottom: 2px solid #4f46e5;
        background: transparent;
    }

    .btn-soft-primary {
        background: #eef2ff;
        color: #4f46e5;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-white {
        background: white;
        color: #4f46e5;
        border: none;
    }
</style>
@endsection