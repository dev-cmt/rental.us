@extends('backEnd.admin.layout.master')
@section('title')
    Properties Management
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Properties Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Properties</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Properties List
                    </div>
                    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Property
                    </a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($properties as $property)
                                <tr>
                                    <td>{{ $property->id }}</td>
                                    <td>
                                       @php
                                            $defaultImagePath = $property->images->firstWhere('is_default', true)?->image_path ?? 'path/to/default-image.jpg';
                                        @endphp
                                        @if ($property->images->count() > 0)
                                            <img src="{{ asset($defaultImagePath) }}" alt="{{ $property->title }}" class="img-thumbnail" width="60">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px;">
                                                <i class="ri-image-line fs-20 text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $property->title }}</td>
                                    <td>${{ number_format($property->price) }}</td>
                                    <td>{{ $property->category->category_name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $property->status == 'active' ? 'success' : 'danger' }}-transparent">
                                            {{ ucfirst($property->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $property->is_featured ? 'primary' : 'secondary' }}-transparent">
                                            {{ $property->is_featured ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-sm btn-warning-light btn-icon">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a href="{{ route('admin.properties.show', $property->id) }}" class="btn btn-sm btn-info-light btn-icon">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this property?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No properties found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $properties->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
</script>
@endsection
