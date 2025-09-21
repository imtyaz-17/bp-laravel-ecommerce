@extends('layouts.app')

@section('title', 'Product Details')
@section('page-title', 'Product Details')
@section('page-description', 'View detailed information about this product')

@section('page-actions')
    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-custom">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Product Name:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $product->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Slug:</strong>
                            </div>
                            <div class="col-md-8">
                                <code>{{ $product->slug }}</code>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Category:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge bg-info">{{ $product->category->name }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Subcategory:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge bg-secondary">{{ $product->subcategory->name }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Description:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $product->description ?: 'No description provided' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Pricing:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($product->old_price)
                                    <div class="d-flex flex-column">
                                        <span class="text-decoration-line-through text-muted fs-5">{{ $product->formatted_old_price }}</span>
                                        <span class="fw-bold fs-4 text-primary">{{ $product->formatted_new_price }}</span>
                                    </div>
                                @else
                                    <span class="fw-bold fs-4 text-primary">{{ $product->formatted_new_price }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($product->is_active)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Created:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $product->created_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Last Updated:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $product->updated_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        @if($product->images->count() > 0)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Images:</strong>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        @foreach($product->images as $image)
                                            <div class="col-md-4 col-sm-6">
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/' . $image->path) }}" 
                                                         class="img-fluid rounded shadow-sm" 
                                                         alt="Product Image" 
                                                         style="width: 100%; height: 200px; object-fit: cover; border: 1px solid #dee2e6;">
                                                    <form action="{{ route('products.images.destroy', [$product->id, $image->id]) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-danger btn-sm rounded-circle" 
                                                                onclick="return confirm('Are you sure you want to delete this image?')" 
                                                                title="Delete Image"
                                                                style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Images:</strong>
                                </div>
                                <div class="col-md-8">
                                    <div class="alert alert-info">
                                        <i class="bi bi-image me-2"></i>No images uploaded for this product.
                                    </div>
                                </div>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-custom px-4">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom px-4" onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="bi bi-trash me-2"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
