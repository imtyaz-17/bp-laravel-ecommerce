@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Product Details</span>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
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
                                    <div class="row">
                                        @foreach($product->images as $image)
                                            <div class="col-md-4 mb-2">
                                                <img src="{{ asset($image->path) }}" class="img-thumbnail" alt="Product Image">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-3" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bi bi-trash me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
