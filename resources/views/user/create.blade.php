@extends('layouts.app')
@section('content')

<form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="name" class="form-label fw-bold small text-uppercase">Name*</label>
        <input type="text" id="name" name="name"
            class="form-control bg-light @error('name') is-invalid @enderror"
            value="{{ old('name') }}" required>
    </div>

    <div class="mb-4">
        <label for="email" class="form-label fw-bold small text-uppercase">Email*</label>
        <input type="email" id="email" name="email"
            class="form-control bg-light @error('email') is-invalid @enderror"
            value="{{ old('email') }}" required>
    </div>

    <div class="mb-4">
        <label for="role" class="form-label fw-bold small text-uppercase">Role*</label>
        <select id="role" name="role" class="form-select bg-light @error('role') is-invalid @enderror" required>
            <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select Role</option>
            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Manager</option>
            <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employee</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="password" class="form-label fw-bold small text-uppercase">Password*</label>
        <input type="password" id="password" name="password"
            class="form-control bg-light @error('password') is-invalid @enderror" required>
    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-secondary text-white px-5 fw-bold">Save User</button>
        <a href="{{ route('user.index') }}" class="btn btn-light border px-4 fw-semibold text-muted">Cancel</a>
    </div>
</form>

@endsection