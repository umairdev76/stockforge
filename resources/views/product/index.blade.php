@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">Inventory Items</h2>
            <p class="text-muted small">Manage products, track stock levels, and monitor SKU health.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('product.create') }}" class="btn btn-primary px-4 shadow-sm">
                <i class="bi bi-box-seam me-2"></i> Add Product
            </a>
        </div>
    </div>

    <div class="glass-panel border-0 shadow-sm mb-4 py-3">
        <form action="{{ route('product.index') }}" method="GET" class="row g-3 align-items-end px-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Category</label>
                <select name="category" class="form-select border-0 bg-light">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted text-uppercase">Supplier</label>
                <select name="supplier" class="form-select border-0 bg-light">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $sup)
                    <option value="{{ $sup->id }}" {{ request('supplier') == $sup->id ? 'selected' : '' }}>{{ $sup->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="form-check form-switch pb-2">
                    <input class="form-check-input" type="checkbox" name="low_stock" id="lowStock" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                    <label class="form-check-label small fw-bold" for="lowStock">Show Low Stock Only</label>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <button type="submit" class="btn btn-dark w-100 py-2">
                    <i class="bi bi-filter me-2"></i>Apply Filters
                </button>
            </div>
        </form>
    </div>

    <div class="glass-panel border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold small text-uppercase">Product</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">SKU</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Category</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Stock Status</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Price</th>
                        <th class="pe-4 py-3 text-muted fw-semibold small text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($products->count() > 0)
                    @foreach($products as $product)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                    class="rounded-3 me-3 border"
                                    style="width: 48px; height: 48px; object-fit: cover;"
                                    onerror="this.src='https://placehold.co/48x48/f1f5f9/64748b?text=Box'">
                                <div>
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.7rem;">{{ $product->supplier->name }}</small>
                                </div>
                            </div>
                        </td>
                        <td><code class="text-primary fw-medium px-2 py-1 bg-primary-subtle rounded small">{{ $product->sku }}</code></td>
                        <td><span class="badge bg-white text-dark border fw-medium">{{ $product->category->name }}</span></td>
                        <td>
                            @if($product->stock_quantity <= 0)
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Out of Stock</span>
                                @elseif($product->stock_quantity <= $product->min_stock_level)
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Low: {{ $product->stock_quantity }}</span>
                                    @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">{{ $product->stock_quantity }} In Stock</span>
                                    @endif
                        </td>
                        <td class="fw-bold text-dark">${{ number_format($product->price, 2) }}</td>
                        <td class="pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="" class="btn btn-sm btn-light border" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border"
                                        onclick="return confirm('Archive this product?')"
                                        title="Delete">
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i class="bi bi-inbox text-muted display-4"></i>
                                <p class="mt-3 text-muted">No inventory items found. Try adjusting your filters.</p>
                                <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-secondary">Clear Filters</a>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection