@extends('backEnd.admin.layout.master')
@section('title')
    Add New Property
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
        <h1 class="page-title fw-semibold fs-18 mb-0">Add New Property</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New</li>
                </ol>
            </nav>
        </div>
    </div>

    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control summernote" rows="5">{!! old('description') !!}</textarea>
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
                                    <input type="number" class="form-control" id="bed_room" name="bed_room" value="0" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="bath_room" class="form-label">Bathrooms</label>
                                    <input type="number" class="form-control" id="bath_room" name="bath_room" value="0" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="dining_room" class="form-label">Dining Rooms</label>
                                    <input type="number" class="form-control" id="dining_room" name="dining_room" value="0" min="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="balcony" class="form-label">Balconies</label>
                                    <input type="number" class="form-control" id="balcony" name="balcony" value="0" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="area_size" class="form-label">Area Size (sqft)</label>
                                    <input type="text" class="form-control" id="area_size" name="area_size" placeholder="e.g., 1500 sq ft">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dimension" class="form-label">Dimension (m)</label>
                                    <input type="text" class="form-control" id="dimension" name="dimension" placeholder="e.g., 20X30m">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="built_year" class="form-label">Built Year</label>
                                    <input type="number" class="form-control" id="built_year" name="built_year" min="1800" max="{{ date('Y') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="property_status" class="form-label">Property Status</label>
                                    <select class="form-select" id="property_status" name="property_status">
                                        <option value="For Sale">For Sale</option>
                                        <option value="For Rent">For Rent</option>
                                        <option value="Sold">Sold</option>
                                        <option value="Under Offer">Under Offer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="condition" class="form-label">Condition</label>
                                    <select class="form-select" id="condition" name="condition">
                                        <option value="New">New</option>
                                        <option value="Resale">Resale</option>
                                        <option value="Under Construction">Under Construction</option>
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
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="state_county" class="form-label">State/County <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="state_county" name="state_county" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Google Map URL</label>
                            <input type="url" class="form-control" id="location" name="location" placeholder="https://maps.google.com/...">
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
                        <label for="images" class="form-label">Property Images</label>

                        <div class="row mt-2" id="images-container">
                            <!-- Add Image Card -->
                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                <label for="images" class="image-container d-flex flex-column align-items-center justify-content-center position-relative" style="cursor:pointer; min-height:100%; border:2px dashed #ced4da;">
                                    <i class="ri-add-line text-secondary fs-3"></i>
                                    <span class="text-secondary fs-6 p-2">Add Image</span>
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
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Features</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($features as $feature)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="features[]" value="{{ $feature->id }}" id="feature{{ $feature->id }}">
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
                                <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1">
                                <label class="form-check-label" for="is_featured">Featured Property</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card custom-card mt-3">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100">Save Property</button>
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

