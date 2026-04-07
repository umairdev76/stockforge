@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">Categories</h2>
            <p class="text-muted small">Organize your products for better inventory tracking.</p>
        </div>
        <a href="{{ route('category.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> New Category
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
    @endif

    <div class="glass-panel border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold small text-uppercase">Category Name</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase">Description</th>
                        <th class="py-3 text-muted fw-semibold small text-uppercase text-center">Products Count</th>
                        <th class="pe-4 py-3 text-muted fw-semibold small text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark">{{ $category->name }}</span>
                            <div class="small text-muted">{{ $category->slug }}</div>
                        </td>
                        <td>
                            <span class="text-muted small">{{ Str::limit($category->description, 50) }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill bg-light text-dark border px-3">
                                {{ $category->products_count }}
                            </span>
                        </td>
                        <td class="pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-light border" title="Edit">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>

                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border"
                                        {{ $category->products_count > 0 ? 'disabled' : '' }}
                                        title="{{ $category->products_count > 0 ? 'Cannot delete: category has products' : 'Delete' }}"
                                        onclick="return confirm('Are you sure?')">
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