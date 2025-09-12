@extends('backEnd.admin.layout.master')
@section('title', 'Payment Methods Management')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Payment Methods Management</h1>
    <div>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Payment Methods</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">Payment Methods List</div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPaymentMethodModal">
                    <i class="ri-add-line me-1"></i> Add New Payment Method
                </button>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                                <th>SL</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>QR Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($paymentMethods as $key => $paymentMethod)
                                <tr>
                                    <td>{{ $paymentMethods->firstItem() + $key }}</td>
                                    <td>{{ $paymentMethod->name }}</td>
                                    <td>
                                        @if($paymentMethod->logo)
                                            <img src="{{ asset($paymentMethod->logo) }}" alt="Logo" class="img-thumbnail" style="width: 40px; height: 40px;">
                                        @else
                                            <span class="text-muted">No Logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($paymentMethod->qr_code)
                                            <img src="{{ asset($paymentMethod->qr_code) }}" alt="QR Code" class="img-thumbnail" style="width: 40px; height: 40px;">
                                        @else
                                            <span class="text-muted">No QR Code</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $paymentMethod->status ? 'success' : 'danger' }}">
                                            {{ $paymentMethod->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-payment-method"
                                                data-id="{{ $paymentMethod->id }}"
                                                data-name="{{ $paymentMethod->name }}"
                                                data-logo="{{ $paymentMethod->logo }}"
                                                data-qr_code="{{ $paymentMethod->qr_code }}"
                                                data-instructions="{{ $paymentMethod->instructions }}"
                                                data-status="{{ $paymentMethod->status }}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPaymentMethodModal">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                        <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment method?')">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No payment methods found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $paymentMethods->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Payment Method Modal -->
<div class="modal fade" id="createPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Create Payment Method</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>QR Code</label>
                                <input type="file" name="qr_code" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Instructions</label>
                        <textarea name="instructions" class="form-control" rows="3" placeholder="Optional instructions for payment method"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Payment Method Modal -->
<div class="modal fade" id="editPaymentMethodModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route('admin.payment-methods.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title">Edit Payment Method</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                <div class="mt-2" id="edit_logo"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>QR Code</label>
                                <input type="file" name="qr_code" class="form-control" accept="image/*">
                                <div class="mt-2" id="edit_qr_code"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Instructions</label>
                        <textarea name="instructions" id="edit_instructions" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).on('click', '.edit-payment-method', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const logo = $(this).data('logo');
        const qr_code = $(this).data('qr_code');
        const instructions = $(this).data('instructions');
        const status = $(this).data('status');

        $('#edit_id').val(id);
        $('#edit_name').val(name);
        $('#edit_instructions').val(instructions);
        $('#edit_status').val(status);

        // Display current logo if available
        if (logo) {
            $('#edit_logo').html(`<small>Current Logo:</small><br>
                <img src="{{ asset('') }}${logo}" width="50" class="img-thumbnail mt-1">`);
        } else {
            $('#edit_logo').html('<span class="badge bg-secondary">No Logo</span>');
        }

        // Display current QR Code if available
        if (qr_code) {
            $('#edit_qr_code').html(`<small>Current QR Code:</small><br>
                <img src="{{ asset('') }}${qr_code}" width="50" class="img-thumbnail mt-1">`);
        } else {
            $('#edit_qr_code').html('<span class="badge bg-secondary">No QR Code</span>');
        }
    });
</script>
@endpush
