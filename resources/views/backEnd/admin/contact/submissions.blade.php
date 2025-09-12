@extends('backEnd.admin.layout.master')
@section('title', 'Contact Submissions')

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <h1 class="page-title fw-semibold fs-18 mb-0">Contact Submissions</h1>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $submission->name }}</td>
                                <td>{{ $submission->email }}</td>
                                <td>{{ Str::limit($submission->subject, 30) }}</td>
                                <td>
                                    <span class="badge bg-{{ $submission->status == 'unread' ? 'warning' : ($submission->status == 'read' ? 'info' : 'success') }}">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </td>
                                <td>{{ $submission->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.contact.submissions.show', $submission->id) }}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('admin.contact.submissions.destroy', $submission->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
