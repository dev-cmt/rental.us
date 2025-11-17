@extends('backEnd.admin.layout.master')
@section('title')
    Edit Property - {{ $property->title }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('backEnd/plugins/summernote/summernote-lite.min.css') }}">
    <style>
        .image-container {position:relative;border:1px solid transparent;overflow:hidden;transition:0.3s;cursor:pointer;}
        .default-image {border-color:#845adf;box-shadow:0 0 15px #845adf8c;}
        .image-container:hover {transform:translateY(-5px);box-shadow:0 10px 20px rgba(0,0,0,0.1);}
        .img-thumbnail {width:100%;aspect-ratio:1/1;object-fit:cover;transition:0.3s;}
        .default-badge {position:absolute;top:10px;right:10px;background:#0d6efd;color:#fff;padding:3px 7px;border-radius:3px;font-size:10px;font-weight:bold;display:none;}
        .image-container.new .default-badge {display:block;background:#28a745;}
        .default-image .default-badge {display:block;}
        .form-check-input[type="radio"] {display:none;}
    </style>
@endpush
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Property</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <!-- Basic Information -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Basic Information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Property Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $property->title) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $property->price) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control summernote" rows="5">{!! $property ? $property->description : '' !!}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Property Details -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Property Details</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="bed_room" class="form-label">Bedrooms</label>
                                    <input type="number" class="form-control" id="bed_room" name="bed_room" value="{{ old('bed_room', $property->bed_room) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="bath_room" class="form-label">Bathrooms</label>
                                    <input type="number" class="form-control" id="bath_room" name="bath_room" value="{{ old('bath_room', $property->bath_room) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="dining_room" class="form-label">Dining Rooms</label>
                                    <input type="number" class="form-control" id="dining_room" name="dining_room" value="{{ old('dining_room', $property->dining_room) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="balcony" class="form-label">Balconies</label>
                                    <input type="number" class="form-control" id="balcony" name="balcony" value="{{ old('balcony', $property->balcony) }}" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="area_size" class="form-label">Area Size (sqft)</label>
                                    <input type="text" class="form-control" id="area_size" name="area_size" value="{{ old('area_size', $property->area_size) }}" placeholder="e.g., 1500 sq ft">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dimension" class="form-label">Dimension (m)</label>
                                    <input type="text" class="form-control" id="dimension" name="dimension" value="{{ old('dimension', $property->dimension) }}" placeholder="e.g., 20X30m">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="built_year" class="form-label">Built Year</label>
                                    <input type="number" class="form-control" id="built_year" name="built_year" value="{{ old('built_year', $property->built_year) }}" min="1800" max="{{ date('Y') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="property_status" class="form-label">Property Status</label>
                                    <select class="form-select" id="property_status" name="property_status">
                                        <option value="For Sale" {{ old('property_status', $property->property_status) == 'For Sale' ? 'selected' : '' }}>For Sale</option>
                                        <option value="For Rent" {{ old('property_status', $property->property_status) == 'For Rent' ? 'selected' : '' }}>For Rent</option>
                                        <option value="Sold" {{ old('property_status', $property->property_status) == 'Sold' ? 'selected' : '' }}>Sold</option>
                                        <option value="Under Offer" {{ old('property_status', $property->property_status) == 'Under Offer' ? 'selected' : '' }}>Under Offer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="condition" class="form-label">Condition</label>
                                    <select class="form-select" id="condition" name="condition">
                                        <option value="New" {{ old('condition', $property->condition) == 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Resale" {{ old('condition', $property->condition) == 'Resale' ? 'selected' : '' }}>Resale</option>
                                        <option value="Under Construction" {{ old('condition', $property->condition) == 'Under Construction' ? 'selected' : '' }}>Under Construction</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Information -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Location Information</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $property->address) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $property->city) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="state_county" class="form-label">State/County <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="state_county" name="state_county" value="{{ old('state_county', $property->state_county) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code', $property->zip_code) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $property->country) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Google Map URL</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $property->location) }}" placeholder="<iframe src='https://www.google.com/maps/...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Media -->
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">Media</div>
                    </div>
                    <div class="card-body">
                        <label for="images" class="form-label mt-3">Property Images</label>

                        <div class="row mt-2" id="images-container">
                            @foreach($property->images as $i => $image)
                                @php $isDefault = $image->is_default || (!$property->images->where('is_default',1)->count() && $i==0); @endphp
                                <div class="col-md-3 col-sm-4 col-6 mb-3 image-wrapper">
                                    <div class="image-container {{ $isDefault ? 'default-image' : '' }}" data-radio="default_{{ $image->id }}">
                                        <img src="{{ asset($image->image_path) }}" class="img-thumbnail">
                                        <div class="default-badge">Default</div>
                                        <input type="radio" name="is_default" class="form-check-input" value="{{ $image->id }}" id="default_{{ $image->id }}" {{ $isDefault ? 'checked' : '' }}>
                                    </div>
                                    <button type="button" class="delete-image btn btn-danger-transparent rounded-0 p-0 mt-1" data-imageid="{{ $image->id }}" style="width:100%;height:22px"><i class="ri-close-line"></i></button>
                                </div>
                            @endforeach

                            <!-- Add Image Card -->
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <label for="images" class="image-container d-flex flex-column align-items-center justify-content-center position-relative" style="cursor:pointer; min-height:100%; border:2px dashed #ced4da;">
                                    <i class="ri-add-line text-secondary fs-2"></i>
                                    <span class="text-secondary fs-6 m-1">Add Image</span>
                                    <span class="selected-count position-absolute top-0 end-0 p-1 text-primary fs-7"></span>
                                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="d-none">
                                </label>
                            </div>
                        </div>

                        {{-- <div class="mb-1">
                            <label class="form-label">Attachments File</label>
                            <div id="attachments-list"></div>
                            <button type="button" class="btn btn-sm btn-primary" id="add-attachment"><i class="ri-add-line me-1"></i> Add Attachment</button>
                        </div> --}}

                        <!-- Template for attachment row (hidden) -->
                        <template id="attachment-template">
                            <div class="d-flex align-items-center gap-2 py-1">
                                <input type="text" name="attachment_name[]" class="form-control me-2" placeholder="e.g, Floor Plan, Brochure">
                                <input type="file" name="attachments[]" class="form-control me-2" accept=".pdf,.doc,.docx">
                                <button type="button" class="btn btn-icon btn-sm btn-danger-light remove-attachment"><i class="ri-delete-bin-line"></i></button>
                            </div>
                        </template>


                        <!-- Existing Attachments -->
                        @if($property->attachments && count($property->attachments) > 0)
                        <div class="mt-4">
                            <h6>Existing Attachments</h6>
                            <ul class="list-group">
                                @foreach($property->attachments as $attachment)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ asset($attachment->file_path) }}" target="_blank">
                                        {{ basename($attachment->file_path) }}
                                    </a>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="delete_attachments[]" value="{{ $attachment->id }}" id="delete_attachment_{{ $attachment->id }}">
                                        <label class="form-check-label" for="delete_attachment_{{ $attachment->id }}">
                                            Delete
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Category & Features -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Category & Features</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $property->category_id) == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($features as $feature)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="features[]"
                                               value="{{ $feature->id }}"
                                               id="feature{{ $feature->id }}"
                                               {{ in_array($feature->id, $property->features->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="feature{{ $feature->id }}">
                                            <i class="{{ $feature->icon_class }} me-1"></i> {{ $feature->feature_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <div class="card custom-card mt-3">
                    <div class="card-header">
                        <div class="card-title">Settings</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                       id="is_featured" name="is_featured" value="1"
                                       {{ old('is_featured', $property->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured Property</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ old('status', $property->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $property->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card custom-card mt-3">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100">Update Property</button>
                        <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('backEnd/plugins/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 150,
            });
        });
    </script>

    <script>
        // Delete Image => Property Image
        $(document).ready(function () {
            $(".delete-image").click(function () {
                if (!confirm("Are you sure you want to delete this image?")) return;

                let parentCol = $(this).closest(".col-md-3");
                let imageId = $(this).data("imageid");

                $.ajax({
                    url: "{{ url('admin/properties/image') }}/" + imageId,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },
                    success: () => parentCol.remove(),
                    error: () => alert("Failed to delete image.")
                });
            });
        });
    </script>

    <script>
        $(function(){
            const $container = $('#images-container');
            // Set Default
            const setDefault = $el => {
                $container.find('.image-container').removeClass('default-image');
                $el.addClass('default-image').find('input[type="radio"]').prop('checked', true);
            };

            // Click images
            $container.on('click', '.image-container', e => {
                if($(e.target).closest('.delete-image, .remove-new').length) return;
                setDefault($(e.currentTarget));
            });

            // Add new images
            $('#images').on('change', function(){
                const files = Array.from(this.files);
                $(this).closest('.image-container').find('.selected-count').text(files.length ? files.length+' file'+(files.length>1?'s':'') : '');

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = e => {
                        const $div = $(`
                            <div class="col-md-3 col-sm-4 col-6 mb-3 text-center image-wrapper">
                                <div class="image-container new ${$container.find('.image-wrapper').length===1?'default-image':''}">
                                    <img src="${e.target.result}" class="img-thumbnail">
                                    <div class="default-badge">New</div>
                                    <input type="radio" name="is_default" class="form-check-input" value="new_${Date.now()}" ${$container.find('.image-wrapper').length===1?'checked':''}>
                                    <button type="button" class="remove-new btn btn-danger-transparent rounded-0 p-0 mt-1" style="width:100%;height:22px"><i class="ri-close-line"></i></button>
                                </div>
                            </div>
                        `).insertBefore($container.children().last());

                        // Remove new image
                        $div.find('.remove-new').on('click', () => $div.remove());
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>

    <script>
        $(function(){
            $('#add-attachment').on('click', function(){
                const $row = $($('#attachment-template').html());
                $('#attachments-list').append($row);

                // Remove row
                $row.find('.remove-attachment').on('click', function(){
                    $row.remove();
                });
            });
        });
    </script>

@endpush
