@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h2 class="fw-bold mb-1 text-dark">User Management</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item active text-dark">Users</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('user.create') }}" class="btn btn-primary shadow-sm px-3">
                <i class="bi bi-person-plus-fill me-2"></i> New User
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="btn btn-sm btn-outline-primary me-3 rounded-circle">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase">Total Users</small>
                        <span class="fw-bold h5 mb-0">{{ $user->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
            <div>
                <div class="fw-semibold text-dark">All Users</div>
                <small class="text-muted">Manage accounts, roles and access</small>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold text-uppercase small">User</th>
                        <th class="py-3 text-muted fw-semibold text-uppercase small">Email</th>
                        <th class="py-3 text-muted fw-semibold text-uppercase small">Role</th>
                        <th class="pe-4 py-3 text-muted fw-semibold text-uppercase small text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($user as $users)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-3 bg-light rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary">
                                    {{ strtoupper(substr($users->name, 0, 1)) }}
                                </div>
                                <span class="fw-medium text-dark">{{ $users->name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted">{{ $users->email }}</span>
                        </td>
                        <td>
                            @php
                                $roleClass = match($users->role) {
                                    'Admin' => 'bg-danger-subtle text-danger border-danger-subtle',
                                    'Manager' => 'bg-primary-subtle text-primary border-primary-subtle',
                                    default => 'bg-secondary-subtle text-secondary border-secondary-subtle'
                                };
                            @endphp
                            <span class="badge border rounded-pill px-3 {{ $roleClass }}">
                                {{ $users->role }}
                            </span>
                        </td>
                        <td class="pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('user.edit', $users->id)}}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </a>

                                <form action="{{ route('user.destroy', $users->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border" title="Delete"
                                        onclick="return confirm('Permanent delete: Are you sure?')"
                                        {{ auth()->id() === $users->id ? 'disabled opacity-50' : '' }}>
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="text-muted">No users found.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
