@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-dark">Create New Product</h2>
                    <p class="text-muted small">Add a new item to your inventory system.</p>
                </div>
                <a href="{{ route('product.index') }}" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-2"></i> Back to List
                </a>
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

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="glass-panel border-0 shadow-sm mb-4">
                            <h5 class="fw-bold mb-4">General Information</h5>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Industrial Grade Hammer" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Description</label>
                                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Provide detailed product specifications...">{{ old('description') }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label fw-medium">SKU (Auto-generated if empty)</label>
                                    <input type="text" name="sku" id="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" placeholder="STK-001">
                                    @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label fw-medium">Unit Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="supplier_id" class="form-label fw-medium">Supplier <span class="text-danger">*</span></label>
                                    <select name="supplier_id" id="supplier_id" class="form-select @error('supplier_id') is-invalid @enderror" required>
                                        <option value="">Select Supplier</option>
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="stock_quantity" class="form-label fw-medium">Initial Stock <span class="text-danger">*</span></label>
                                    <input type="number" name="stock_quantity" id="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', 0) }}" required>
                                    @error('stock_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="min_stock_level" class="form-label fw-medium">Low Stock Threshold <span class="text-danger">*</span></label>
                                    <input type="number" name="min_stock_level" id="min_stock_level" class="form-control @error('min_stock_level') is-invalid @enderror" value="{{ old('min_stock_level', 10) }}" required>
                                    @error('min_stock_level') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="glass-panel border-0 shadow-sm mb-4">
                            <h5 class="fw-bold mb-4">Product Image</h5>
                            <div class="text-center mb-3">
                                <div id="imagePreviewContainer" class="bg-light rounded-3 d-flex align-items-center justify-content-center border" style="height: 115px; overflow: hidden;">
                                    <i class="bi bi-image text-muted display-4" id="placeholderIcon"></i>
                                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid d-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="file" name="image" id="imageInput" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Max size: 2MB (JPG, PNG)</small>
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold shadow-sm">
                                <i class="bi bi-check-circle me-2"></i> Save Product
                            </button>
                            <button type="reset" class="btn btn-light border py-2">Clear Form</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image Preview Logic
    document.getElementById('imageInput').onchange = evt => {
        const [file] = evt.target.files
        if (file) {
            document.getElementById('imagePreview').src = URL.createObjectURL(file)
            document.getElementById('imagePreview').classList.remove('d-none')
            document.getElementById('placeholderIcon').classList.add('d-none')
        }
    }
</script>
@endsection