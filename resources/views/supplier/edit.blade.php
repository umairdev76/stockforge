@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('supplier.index') }}" class="text-decoration-none small">
                    <i class="bi bi-x-circle me-1"></i> Cancel Changes
                </a>
                <h3 class="fw-bold mt-2">Edit Supplier: {{ $supplier->name }}</h3>
            </div>

            <div class="glass-panel border-0 shadow-sm">
                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-medium">Supplier Company Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $supplier->name) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email', $supplier->contact_email) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $supplier->phone) }}">
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-medium">Office Address</label>
                            <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $supplier->address) }}</textarea>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 fw-bold">Update Records</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection