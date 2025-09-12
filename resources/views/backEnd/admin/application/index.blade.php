@extends('backEnd.admin.layout.master')
@section('title','Applications')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Applications</h1>
    <div>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Applications</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card custom-card">
    <div class="card-header">
        <form action="{{ route('admin.application.index') }}" class="d-flex">
            <input type="text" name="query" class="form-control form-control-sm me-2"
                   value="{{ request()->query('query') }}" placeholder="Search by name, email, phone">
            <button class="btn btn-success btn-sm me-1" type="submit">Search</button>
            <a href="{{ route('admin.application.index') }}" class="btn btn-dark btn-sm"><i class="ti ti-refresh"></i></a>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Personal Info</th>
                        <th>Address details</th>
                        <th>Citizenship</th>
                        <th style="width:1%">Document</th>
                        <th style="width:1%">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($applications as $key=>$app)
                    <tr>
                        <td>{{ $applications->firstItem() + $key }}</td>
                        <td>
                            <strong>Name:</strong> {{ $app->full_name }} <br>
                            <strong>Email:</strong> {{ $app->email }} <br>
                            <strong>Phone:</strong> {{ $app->phone }} <br>
                            <strong>Move-in:</strong> {{ $app->move_in_date ? date('d-M-Y', strtotime($app->move_in_date)) : 'N/A' }} <br>
                            <strong>Type:</strong> <span class="badge bg-info">{{ ucfirst($app->application_type) }}</span>
                        </td>
                        <td>
                            {{ $app->current_address }} <br>
                            {{ $app->city }}, {{ $app->state }} - {{ $app->zip_code }} <br>
                            {{ $app->country }}
                        </td>
                        <td>
                            <strong>DOB:</strong> {{ $app->dob ? date('d-M-Y', strtotime($app->dob)) : 'N/A' }} <br>
                            <strong>Citizenship:</strong> {{ $app->citizenship ? ucfirst($app->citizenship) : '' }} <br>
                            <strong>SSN:</strong> {{ $app->ssn ? $app->ssn : '' }} <br>
                            <strong>Government ID:</strong> {{ $app->government_id ? $app->government_id : 'N/A' }} <br>
                            <strong>Issuing State:</strong> {{ $app->issuing_state ? $app->issuing_state : 'N/A' }} <br>

                        </td>
                        <td class="d-flex flex-column gap-1 w-100">
                            <a href="{{ asset($app->id_front_path) }}" target="_blank" class="badge bg-primary">ID Front</a>
                            <a href="{{ asset($app->id_back_path) }}" target="_blank" class="badge bg-primary">ID Back</a>
                            <a href="{{ asset($app->selfie_path) }}" target="_blank" class="badge bg-primary">Selfie</a>
                            <a href="{{ asset($app->income_path) }}" target="_blank" class="badge bg-primary">Income</a>
                            <a href="{{ asset($app->payment_path) }}" target="_blank" class="badge bg-primary">Payment</a>
                        </td>
                        <td>
                            <span class="badge bg-{{ $app->status == 'approved' ? 'success' : ($app->status=='rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.zip.image.download', $app->id) }}"
                                onclick="return confirm('Are You Sure?')"
                                class="btn btn-outline-info btn-sm mb-1"><i class="ti ti-file-zip"></i>
                            </a>
                            <form action="{{ route('admin.application.delete', $app->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are You Sure?')"
                                class="btn btn-outline-danger btn-sm"><i class="ti ti-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-danger">No Applications Found!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
        {{ $applications->links() }}
    </div>
</div>
@endsection
