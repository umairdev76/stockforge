@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <a href="{{ route('product.index') }}" class="text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Back to Inventory</a>
                <h3 class="fw-bold mt-2">Edit Product: {{ $product->name }}</h3>
            </div>

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

            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="glass-panel border-0 shadow-sm mb-4">
                            <h5 class="fw-bold mb-4">Update Details</h5>

                            <div class="mb-3">
                                <label class="form-label fw-medium">Product Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-medium">Description</label>
                                <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{ $product->sku }}" readonly>
                                    <small class="text-muted">SKU cannot be changed after creation.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium">Price ($)</label>
                                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-panel border-0 shadow-sm mb-4 text-center">
                            <h5 class="fw-bold mb-4 text-start">Product Image</h5>

                            <div class="mb-3 bg-light rounded-3 p-2 border">
                                <p class="small text-muted mb-2">Current Image:</p>
                                <img id="imagePreview" src="{{ asset('storage/products/' . $product->image) }}" class="img-fluid rounded-2 mb-3" style="max-height: 200px;">
                            </div>

                            <div class="text-start">
                                <label class="form-label fw-medium">Change Image (Max 2MB)</label>
                                <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">Update Product</button>
                            <a href="{{ route('product.index') }}" class="btn btn-light border">Cancel</a>
                        </div>
                    </div>

                    <div class="glass-panel border-0 shadow-sm">
                        <h5 class="fw-bold mb-4">Inventory & Relationships</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-medium">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="supplier_id" class="form-label fw-medium">Supplier <span class="text-danger">*</span></label>
                                <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id ? 'selected' : ''}}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="stock_quantity" class="form-label fw-medium">Initial Stock <span class="text-danger">*</span></label>
                                <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                @error('stock_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="min_stock_level" class="form-label fw-medium">Low Stock Threshold <span class="text-danger">*</span></label>
                                <input type="number" name="min_stock_level" id="min_stock_level" class="form-control @error('min_stock_level') is-invalid @enderror" value="{{ old('min_stock_level', $product->min_stock_level) }}" required>
                                @error('min_stock_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('imageInput').onchange = evt => {
        const [file] = evt.target.files
        if (file) {
            document.getElementById('imagePreview').src = URL.createObjectURL(file)
        }
    }
</script>
@endsection