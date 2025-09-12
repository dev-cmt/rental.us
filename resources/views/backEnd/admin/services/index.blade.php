@extends('backEnd.admin.layout.master')
@section('title')
    Services Management
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Services Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Services List
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createServiceModal">
                        <i class="ri-add-line me-1 fw-semibold align-middle"></i>Add New Service
                    </button>
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

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $key => $service)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        @if($service->image)
                                            <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" style="max-height: 50px; max-width: 80px;">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $service->title }}</td>
                                    <td>{{ Str::limit($service->description, 50) }}</td>
                                    <td>{{ $service->sort_order }}</td>
                                    <td>
                                        <span class="badge bg-{{ $service->status == 'active' ? 'success' : 'danger' }}-transparent">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <button type="button" class="btn btn-sm btn-warning-light btn-icon edit-service"
                                                data-id="{{ $service->id }}"
                                                data-title="{{ $service->title }}"
                                                data-description="{{ $service->description }}"
                                                data-icon="{{ $service->icon }}"
                                                data-sort_order="{{ $service->sort_order }}"
                                                data-status="{{ $service->status }}"
                                                data-meta_title="{{ $service->meta_title }}"
                                                data-meta_description="{{ $service->meta_description }}"
                                                data-image="{{ $service->image }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editServiceModal">
                                                <i class="ri-pencil-line"></i>
                                            </button>
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure you want to delete this service?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No services found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Service Modal -->
    <div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="createServiceModalLabel">Create New Service</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon Class <span class="text-danger">*</span>
                                        <a class="badge bg-success" href="https://dev-cmt.github.io/fontawesome.com" target="_blank">click</a>
                                    </label>
                                    <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g., flaticon-architecture">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Service Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editServiceModalLabel">Edit Service</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.services.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_icon" class="form-label">Icon Class <span class="text-danger">*</span>
                                        <a class="badge bg-success" href="https://dev-cmt.github.io/fontawesome.com" target="_blank">click</a>
                                    </label>
                                    <input type="text" class="form-control" id="edit_icon" name="icon" placeholder="e.g., flaticon-architecture">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">Service Image</label>
                                    <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                                    <small class="form-text text-muted">Leave empty to keep current image</small>
                                    <div id="current-image" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="edit_sort_order" class="form-label">Sort Order</label>
                                    <input type="number" class="form-control" id="edit_sort_order" name="sort_order">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="edit_status" class="form-label">Status</label>
                                    <select class="form-select" id="edit_status" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Service</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    // Handle edit button click
    $(document).on('click', '.edit-service', function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        const icon = $(this).data('icon');
        const sort_order = $(this).data('sort_order');
        const status = $(this).data('status');
        const meta_title = $(this).data('meta_title');
        const meta_description = $(this).data('meta_description');
        const image = $(this).data('image');

        $('#edit_id').val(id);
        $('#edit_title').val(title);
        $('#edit_description').val(description);
        $('#edit_icon').val(icon);
        $('#edit_sort_order').val(sort_order);
        $('#edit_status').val(status);

        // Display current image if available
        if (image) {
            $('#current-image').html(`<img src="{{ asset('') }}${image}" alt="Current Image" style="max-height: 100px;">`);
        } else {
            $('#current-image').html('<span class="text-muted">No image uploaded</span>');
        }
    });

    // Clear form when create modal is closed
    $('#createServiceModal').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
    });
</script>
@endpush
