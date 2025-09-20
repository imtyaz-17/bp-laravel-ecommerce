@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Category Details</span>
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
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
                            <div class="col-md-12">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning px-3">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-3" onclick="return confirm('Are you sure you want to delete this category?')">
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
