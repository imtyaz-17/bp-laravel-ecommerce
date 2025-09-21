@extends('layouts.app')

@section('title', 'Subcategory Details')
@section('page-title', 'Subcategory Details')
@section('page-description', 'View detailed information about this subcategory')

@section('page-actions')
    <a href="{{ route('subcategories.index') }}" class="btn btn-outline-light btn-custom">
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
                                <strong>Name:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $subcategory->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Slug:</strong>
                            </div>
                            <div class="col-md-8">
                                <code>{{ $subcategory->slug }}</code>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Category:</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge bg-info">{{ $subcategory->category->name }}</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Description:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $subcategory->description ?: 'No description provided' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($subcategory->is_active)
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
                                {{ $subcategory->created_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Last Updated:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $subcategory->updated_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        @if($subcategory->products->count() > 0)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Products:</strong>
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-unstyled">
                                        @foreach($subcategory->products as $product)
                                            <li>
                                                <i class="bi bi-arrow-right"></i> {{ $product->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-custom px-4">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>
                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom px-4" onclick="return confirm('Are you sure you want to delete this subcategory? This will also delete all associated products.')">
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
