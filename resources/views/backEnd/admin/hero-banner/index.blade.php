@extends('backEnd.admin.layout.master')
@section('title')
    Hero Banner Management
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Hero Banner Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hero Banner</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Hero Banner Settings
                    </div>
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

                    <form action="{{ route('admin.hero-banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="badge_text" class="form-label">Badge Text</label>
                                    <input type="text" class="form-control" id="badge_text" name="badge_text"
                                           value="{{ old('badge_text', $heroBanner->badge_text ?? 'Get Discount Contact Our Agent') }}"
                                           placeholder="e.g., New, Featured, etc.">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="badge_color" class="form-label">Badge Color</label>
                                    <select class="form-select" id="badge_color" name="badge_color">
                                        <option value="bg-green" {{ ($heroBanner->badge_color ?? 'bg-green') == 'bg-green' ? 'selected' : '' }}>Green</option>
                                        <option value="bg-blue" {{ ($heroBanner->badge_color ?? '') == 'bg-blue' ? 'selected' : '' }}>Blue</option>
                                        <option value="bg-red" {{ ($heroBanner->badge_color ?? '') == 'bg-red' ? 'selected' : '' }}>Red</option>
                                        <option value="bg-yellow" {{ ($heroBanner->badge_color ?? '') == 'bg-yellow' ? 'selected' : '' }}>Yellow</option>
                                        <option value="bg-purple" {{ ($heroBanner->badge_color ?? '') == 'bg-purple' ? 'selected' : '' }}>Purple</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ old('title', $heroBanner->title ?? 'Find Your Dream House') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $heroBanner->description ?? 'Find homes in 80+ different countries represented by 700 leading member brokerages.') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="search_locations" class="form-label">Search Locations</label>
                                    <textarea class="form-control" id="search_locations" name="search_locations" rows="3"
                                              placeholder="Enter locations separated by commas">{{ old('search_locations', $heroBanner ? implode(', ', $heroBanner->search_locations ?? []) : 'California, Denver, Las Vegas, San Antonio, San Francisco, Los Angeles, New Orleans, San Diego') }}</textarea>
                                    <small class="form-text text-muted">Separate locations with commas</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="popular_searches" class="form-label">Popular Searches</label>
                                    <textarea class="form-control" id="popular_searches" name="popular_searches" rows="3"
                                              placeholder="Enter popular searches separated by commas">{{ old('popular_searches', $heroBanner ? implode(', ', $heroBanner->popular_searches ?? []) : '2 BHK, Banglaw, Apartment, London, Villa') }}</textarea>
                                    <small class="form-text text-muted">Separate searches with commas</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Hero Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if(isset($heroBanner) && $heroBanner->image)
                                <div class="mt-2">
                                    <img src="{{ asset($heroBanner->image) }}" alt="Hero Banner" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                   {{ ($heroBanner->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Settings</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
