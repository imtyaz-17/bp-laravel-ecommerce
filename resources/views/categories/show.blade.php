@extends('layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details')
@section('page-description', 'View detailed information about this category')

@section('page-actions')
    <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-custom">
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
                                {{ $category->name }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Slug:</strong>
                            </div>
                            <div class="col-md-8">
                                <code>{{ $category->slug }}</code>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Description:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $category->description ?: 'No description provided' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Status:</strong>
                            </div>
                            <div class="col-md-8">
                                @if($category->is_active)
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
                                {{ $category->created_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Last Updated:</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $category->updated_at->format('M d, Y \a\t h:i A') }}
                            </div>
                        </div>

                        @if($category->subcategories->count() > 0)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Subcategories:</strong>
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-unstyled">
                                        @foreach($category->subcategories as $subcategory)
                                            <li>
                                                <i class="bi bi-arrow-right"></i> {{ $subcategory->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex gap-3 justify-content-center">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-custom px-4">
                                    <i class="bi bi-pencil me-2"></i>Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-custom px-4" onclick="return confirm('Are you sure you want to delete this category? This will also delete all associated subcategories and products.')">
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
