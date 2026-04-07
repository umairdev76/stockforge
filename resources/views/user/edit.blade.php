@extends('layouts.app')
@section('content')
@if ($errors->any())
<div class="alert alert-danger border-0 shadow-sm rounded-3">
    <p class="fw-bold mb-2">Validation Errors</p>
    <ul class="mb-0 small">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('user.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="form-label fw-bold small text-uppercase">Name*</label>
        <input type="text" id="name" name="name"
            class="form-control bg-light @error('name') is-invalid @enderror"
            value="{{ old('name',$user->name) }}" required>
    </div>

    <div class="mb-4">
        <label for="email" class="form-label fw-bold small text-uppercase">Email*</label>
        <input type="email" id="email" name="email"
            class="form-control bg-light @error('email') is-invalid @enderror"
            value="{{ old('email',$user->email) }}" required>
    </div>

    <div class="mb-4">
        <label for="role" class="form-label fw-bold small text-uppercase">Role*</label>
        <select id="role" name="role" class="form-select bg-light @error('role') is-invalid @enderror" required>
            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="manager" {{ old('role', $user->role) === 'manager' ? 'selected' : '' }}>Manager</option>
            <option value="employee" {{ old('role', $user->role) === 'employee' ? 'selected' : '' }}>Employee</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="password" class="form-label fw-bold small text-uppercase">Password(OPTIONAL)*</label>
        <input type="password" id="password" name="password"
            class="form-control bg-light @error('password') is-invalid @enderror">
    </div>

    <div class="d-flex gap-2 mt-4">
        <button type="submit" class="btn btn-secondary text-white px-5 fw-bold">Update User</button>
        <a href="{{ route('user.index') }}" class="btn btn-light border px-4 fw-semibold text-muted">Cancel</a>
    </div>
</form>

@endsection