@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Subcategories</span>
                        <a href="{{ route('subcategories.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add New Subcategory
                        </a>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <tr>
                                <th class="fw-bold">No</th>
                                <th class="fw-bold">Name</th>
                                <th class="fw-bold">Category</th>
                                <th class="fw-bold">Description</th>
                                <th class="fw-bold">Status</th>
                                <th class="fw-bold" width="280px">Action</th>
                            </tr>
                            @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $subcategory->category->name }}</span>
                                    </td>
                                    <td>{{ Str::limit($subcategory->description, 50) }}</td>
                                    <td>
                                        @if($subcategory->is_active)
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
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('subcategories.show',$subcategory->id) }}" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-warning btn-sm" href="{{ route('subcategories.edit',$subcategory->id) }}" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('subcategories.destroy',$subcategory->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $subcategories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
