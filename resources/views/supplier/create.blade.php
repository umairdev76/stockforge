@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('supplier.index') }}" class="text-decoration-none small">
                    <i class="bi bi-arrow-left me-1"></i> Back to Suppliers
                </a>
                <h3 class="fw-bold mt-2">Register New Supplier</h3>
            </div>

            <div class="glass-panel border-0 shadow-sm">
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-medium">Supplier Company Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g., Acme Industrial Supplies" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control @error('contact_email') is-invalid @enderror" value="{{ old('contact_email') }}" placeholder="contact@acme.com" required>
                            @error('contact_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Phone Number</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-medium">Office Address</label>
                            <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Enter full business address..." required>{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm">
                            <i class="bi bi-check2-square me-2"></i> Register Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection