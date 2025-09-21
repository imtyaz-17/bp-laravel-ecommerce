@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products Management')
@section('page-description', 'Complete product management with images, pricing, descriptions, and detailed categorization')

@section('page-actions')
    <a href="{{ route('products.create') }}" class="btn btn-light btn-custom">
        <i class="bi bi-plus-circle me-2"></i>Add New Product
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
                                    <th class="fw-bold">Image</th>
                                    <th class="fw-bold">Name</th>
                                    <th class="fw-bold">Category</th>
                                    <th class="fw-bold">Subcategory</th>
                                    <th class="fw-bold">Price</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                        <td>
                                            @if($product->images->count() > 0)
                                                <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                                     class="img-thumbnail rounded" 
                                                     alt="{{ $product->name }}" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded" 
                                                     style="width: 60px; height: 60px; border: 1px solid #dee2e6;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-box-seam me-2 text-warning"></i>
                                                <strong>{{ $product->name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                <i class="bi bi-grid me-1"></i>{{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-collection me-1"></i>{{ $product->subcategory->name }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->old_price)
                                                <div class="d-flex flex-column">
                                                    <span class="text-decoration-line-through text-muted small">{{ $product->formatted_old_price }}</span>
                                                    <span class="fw-bold text-primary">{{ $product->formatted_new_price }}</span>
                                                </div>
                                            @else
                                                <span class="fw-bold text-primary">{{ $product->formatted_new_price }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->is_active)
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
                                                <a class="btn btn-outline-primary btn-sm" href="{{ route('products.show',$product->id) }}" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="btn btn-outline-warning btn-sm" href="{{ route('products.edit',$product->id) }}" title="Edit Product">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('products.destroy',$product->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bi bi-box-seam display-4 d-block mb-3"></i>
                                                <h5>No products found</h5>
                                                <p>Start by creating your first product to showcase your inventory.</p>
                                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                                    <i class="bi bi-plus-circle me-2"></i>Create First Product
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($products->hasPages())
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
