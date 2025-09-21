@extends('layouts.app')

@section('title', 'Subcategories')
@section('page-title', 'Subcategories Management')
@section('page-description', 'Create detailed subcategories under main categories for better product organization')

@section('page-actions')
    <a href="{{ route('subcategories.create') }}" class="btn btn-light btn-custom">
        <i class="bi bi-plus-circle me-2"></i>Add New Subcategory
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
                                    <th class="fw-bold">Category</th>
                                    <th class="fw-bold">Description</th>
                                    <th class="fw-bold">Products</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $loop->iteration + ($subcategories->currentPage() - 1) * $subcategories->perPage() }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-collection me-2 text-success"></i>
                                                <strong>{{ $subcategory->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                <i class="bi bi-grid me-1"></i>{{ $subcategory->category->name }}
                                            </span>
                                        </td>
                                        <td>{{ $subcategory->description ? Str::limit($subcategory->description, 50) : 'No description' }}</td>
                                        <td>
                                            <span class="badge bg-warning">{{ $subcategory->products->count() }} products</span>
                                        </td>
                                        <td>
                                            @if($subcategory->is_active)
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
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('subcategories.show',$subcategory->id) }}" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-sm" href="{{ route('subcategories.edit',$subcategory->id) }}" title="Edit Subcategory">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('subcategories.destroy',$subcategory->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Subcategory" onclick="return confirm('Are you sure you want to delete this subcategory? This will also delete all associated products.')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-collection display-4 d-block mb-3"></i>
                                                <h5>No subcategories found</h5>
                                                <p>Start by creating your first subcategory to organize your products better.</p>
                                                <a href="{{ route('subcategories.create') }}" class="btn btn-primary">
                                                    <i class="bi bi-plus-circle me-2"></i>Create First Subcategory
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($subcategories->hasPages())
                        <div class="mt-4">
                            {{ $subcategories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
