@extends('backEnd.admin.layout.master')
@section('title')
    View Property - {{ $property->title }}
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">View Property</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">

            <!-- Property Title & Price -->
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1">{{ $property->title }}</h3>
                        <span class="text-muted fs-14">Listed at: <strong>${{ number_format($property->price, 2) }}</strong></span>
                    </div>
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-primary btn-sm">Edit Property</a>
                </div>
            </div>

            <!-- Tabs for Info -->
            <div class="card shadow-sm">
                <div class="card-header bg-white p-0 border-bottom-0">
                    <ul class="nav nav-tabs card-header-tabs" id="propertyTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button">Basic Info</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">Details</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" type="button">Location</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button">Images</button>
                        </li>
                    </ul>
                </div>

                <div class="card-body tab-content" id="propertyTabContent">

                    <!-- Basic Info -->
                    <div class="tab-pane fade show active" id="basic">
                        <h5 class="mb-2 fw-semibold">Description</h5>
                        <p>{!! $property->description !!}</p>
                    </div>

                    <!-- Property Details -->
                    <div class="tab-pane fade" id="details">
                        <div class="row">
                            <div class="col-md-4 mb-2"><strong>Bedrooms:</strong> {{ $property->bed_room ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Bathrooms:</strong> {{ $property->bath_room ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Dining Rooms:</strong> {{ $property->dining_room ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Balconies:</strong> {{ $property->balcony ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Area Size:</strong> {{ $property->area_size ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Dimension:</strong> {{ $property->dimension ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Built Year:</strong> {{ $property->built_year ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Status:</strong> {{ $property->property_status ?? 'N/A' }}</div>
                            <div class="col-md-4 mb-2"><strong>Condition:</strong> {{ $property->condition ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <!-- Location Info -->
                    <div class="tab-pane fade" id="location">
                        <h5 class="fw-semibold">Address</h5>
                        <p>{{ $property->address }}</p>
                        <div class="row">
                            <div class="col-md-4 mb-2"><strong>City:</strong> {{ $property->city }}</div>
                            <div class="col-md-4 mb-2"><strong>State/County:</strong> {{ $property->state_county }}</div>
                            <div class="col-md-4 mb-2"><strong>Zip Code:</strong> {{ $property->zip_code }}</div>
                            <div class="col-md-6 mb-2"><strong>Country:</strong> {{ $property->country }}</div>
                        </div>
                        @if($property->location)
                        <a href="{{ $property->location }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2">View on Google Maps</a>
                        @endif
                    </div>

                    <!-- Property Images -->
                    <div class="tab-pane fade" id="images">
                        @if($property->images && count($property->images) > 0)
                        <div class="row g-2">
                            <style>
                                .property-image {
                                    width: 100%;
                                    aspect-ratio: 1/1;
                                    object-fit: cover;
                                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                                }

                                .property-image:hover {
                                    transform: scale(1.1);
                                    box-shadow: 0 10px 20px rgba(0,0,0,0.3);
                                }
                            </style>
                            @foreach($property->images as $image)
                               <div class="col-md-3 mb-3">
                                    <div class="card shadow-sm overflow-hidden">
                                        <img src="{{ asset($image->image_path) }}"
                                            class="property-image card-img-top"
                                            alt="Property Image">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @else
                            <p>No images available.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">

            <!-- Category & Features -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Category & Features</h5>
                </div>
                <div class="card-body">
                    <p><strong>Category:</strong> {{ $property->category->category_name ?? 'N/A' }}</p>
                    @if($property->features && count($property->features) > 0)
                    <div>
                        <strong>Features:</strong>
                        <div class="mt-1">
                            @foreach($property->features as $feature)
                                <span class="badge bg-primary me-1 mb-1">
                                    <i class="{{ $feature->icon_class }} me-1"></i>{{ $feature->feature_name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Settings -->
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Settings</h5>
                </div>
                <div class="card-body">
                    <p><strong>Featured Property:</strong> {{ $property->is_featured ? 'Yes' : 'No' }}</p>
                    <p><strong>Status:</strong>
                        <span class="badge bg-{{ $property->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($property->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Attachments -->
            @if($property->attachments && count($property->attachments) > 0)
            <div class="card shadow-sm mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Attachments</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($property->attachments as $attachment)
                        <li class="list-group-item">
                            <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                                <i class="fas fa-file me-2"></i>{{ basename($attachment->file_path) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <a href="{{ route('admin.properties.edit', $property->id) }}" class="btn btn-primary w-100 mb-2">Edit Property</a>
                    <form action="{{ route('admin.properties.destroy', $property->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this property?')">Delete Property</button>
                    </form>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary w-100 mt-2">Back to List</a>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
