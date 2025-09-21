@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Edit Product</span>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <form action="{{ route('products.update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="category_id" class="col-md-4 col-form-label text-md-end">Category <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                        <option value="">Select a Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="subcategory_id" class="col-md-4 col-form-label text-md-end">Subcategory <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <select id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" required>
                                        <option value="">Select a Subcategory</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }} ({{ $subcategory->category->name }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('subcategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Product Name <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description', $product->description) }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="old_price" class="col-md-4 col-form-label text-md-end">Old Price</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input id="old_price" type="number" step="0.01" min="0" class="form-control @error('old_price') is-invalid @enderror" name="old_price" value="{{ old('old_price', $product->old_price) }}">
                                    </div>

                                    @error('old_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new_price" class="col-md-4 col-form-label text-md-end">New Price <span class="text-danger">*</span></label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input id="new_price" type="number" step="0.01" min="0" class="form-control @error('new_price') is-invalid @enderror" name="new_price" value="{{ old('new_price', $product->new_price) }}" required>
                                    </div>

                                    @error('new_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary px-3">
                                            <i class="bi bi-check-circle me-1"></i> Update
                                        </button>
                                        <a href="{{ route('products.index') }}" class="btn btn-secondary px-3">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
