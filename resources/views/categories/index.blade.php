@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories Management')
@section('page-description', 'Organize your products with a hierarchical category system')

@section('page-actions')
    <a href="{{ route('categories.create') }}" class="btn btn-light btn-custom">
        <i class="bi bi-plus-circle me-2"></i>Add New Category
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="fw-bold">#</th>
                                    <th class="fw-bold">Name</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Subcategories</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-grid me-2 text-primary"></i>
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ $category->description ? Str::limit($category->description, 50) : 'No description' }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $category->subcategories->count() }} subcategories</span>
                                        </td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i>Active
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="bi bi-x-circle me-1"></i>Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('categories.show',$category->id) }}" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-sm" href="{{ route('categories.edit',$category->id) }}" title="Edit Category">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy',$category->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Category" onclick="return confirm('Are you sure you want to delete this category? This will also delete all associated subcategories and products.')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-inbox display-4 d-block mb-3"></i>
                                                <h5>No categories found</h5>
                                                <p>Start by creating your first category to organize your products.</p>
                                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                                    <i class="bi bi-plus-circle me-2"></i>Create First Category
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($categories->hasPages())
                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
