@extends('backEnd.admin.layout.master')
@section('title', isset($team) ? 'Edit Team Member' : 'Add Team Member')

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($team) ? 'Edit Team Member' : 'Add Team Member' }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ isset($team) ? 'Edit' : 'Add' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
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

                    <form action="{{ isset($team) ? route('admin.team.update', $team->id) : route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($team)) @method('PUT') @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $team->name ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $team->position ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $team->bio ?? '') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if(isset($team) && $team->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($team->image) }}" alt="Current Image" class="img-thumbnail" width="150">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $team->order ?? 0) }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="active" {{ old('status', $team->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $team->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook URL</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $team->facebook ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter URL</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $team->twitter ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram URL</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $team->instagram ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="linkedin" class="form-label">LinkedIn URL</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $team->linkedin ?? '') }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($team) ? 'Update' : 'Create' }} Team Member
                        </button>
                        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
