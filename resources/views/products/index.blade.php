@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Products</span>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add New Product
                        </a>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="fw-bold">No</th>
                                    <th class="fw-bold">Image</th>
                                    <th class="fw-bold">Name</th>
                                    <th class="fw-bold">Category</th>
                                    <th class="fw-bold">Subcategory</th>
                                    <th class="fw-bold">Price</th>
                                    <th class="fw-bold">Status</th>
                                    <th class="fw-bold" width="280px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        @if($product->images->count() > 0)
                                            <img src="{{ asset('storage/' . $product->images->first()->path) }}" 
                                                 class="img-thumbnail" 
                                                 alt="{{ $product->name }}" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px; border: 1px solid #dee2e6;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $product->category->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->subcategory->name }}</span>
                                    </td>
                                    <td>
                                        @if($product->old_price)
                                            <div class="d-flex flex-column">
                                                <span class="text-decoration-line-through text-muted small">{{ $product->formatted_old_price }}</span>
                                                <span class="fw-bold">{{ $product->formatted_new_price }}</span>
                                            </div>
                                        @else
                                            <span class="fw-bold">{{ $product->formatted_new_price }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('products.show',$product->id) }}" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-warning btn-sm" href="{{ route('products.edit',$product->id) }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('products.destroy',$product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
