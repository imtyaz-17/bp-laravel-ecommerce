@extends('layouts.app')

@section('title', 'Create Category')
@section('page-title', 'Create New Category')
@section('page-description', 'Add a new category to organize your products')

@section('page-actions')
    <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-custom">
        <i class="bi bi-arrow-left me-2"></i>Back to Categories
    </a>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <label for="name" class="col-md-3 col-form-label fw-bold">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9">
                                <input id="name" type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       required 
                                       autocomplete="name" 
                                       autofocus
                                       placeholder="Enter category name">
                                <div class="form-text">Choose a descriptive name for your category</div>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-md-3 col-form-label fw-bold">Description</label>
                            <div class="col-md-9">
                                <textarea id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          name="description" 
                                          rows="4"
                                          placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                                <div class="form-text">Provide a brief description of this category</div>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-9 offset-md-3">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="is_active" 
                                           id="is_active" 
                                           value="1" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="is_active">
                                        <i class="bi bi-check-circle me-1"></i>Active Category
                                    </label>
                                    <div class="form-text">Inactive categories won't be visible to users</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9 offset-md-3">
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn btn-primary btn-custom px-4">
                                        <i class="bi bi-check-circle me-2"></i>Create Category
                                    </button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-custom px-4">
                                        <i class="bi bi-x-circle me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
