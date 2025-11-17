<x-frontend-layout>
@section('title', 'Appointment Form')
@push('css')
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .rental-header {
            background: linear-gradient(135deg, #0987f5 0%, #6f42c1 100%);
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .required-label::after {
            content: " *";
            color: #dc3545;
        }
        .file-upload-container {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s;
            background-color: #f8f9fa;
            position: relative;
        }
        .file-upload-container.has-error {
            border-color: #dc3545;
            background-color: #f8d7da30;
        }
        .file-upload-container:hover {
            border-color: #0987f5;
            background-color: #0987f521;
        }
        .payment-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-left: 4px solid #ffd700;
            padding: 25px;
            border-radius: 10px;
        }
        .progress-bar {
            background-color: #0987f5;
        }
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            position: relative;
        }
        .step-indicator:before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #dee2e6;
            z-index: 1;
        }
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 30%;
        }
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #dee2e6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: bold;
        }
        .step.active .step-number {
            background-color: #0987f5;
        }
        .step.completed .step-number {
            background-color: #28a745;
        }
        .step-label {
            font-size: 0.85rem;
            color: #6c757d;
        }
        .step.active .step-label {
            color: #0987f5;
            font-weight: 500;
        }
        .dashboard-wraper {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }
        .page-title {
            background: linear-gradient(90deg, #6f42c1 0%, #0987f5 100%);
            color: white;
            padding: 30px 0;
            text-align: center;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
            display: none;
        }
        .form-control.has-error, .form-select.has-error {
            border-color: #dc3545 !important;
        }
        .file-error {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
    </style>
@endpush

@section('breadcrumb')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">Appointment</h2>
                    <span class="ipn-subtitle">Let's Find You Together The Place You Deserve</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
@endsection

@section('content')

    <!-- Main Content -->
    <section class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Progress Indicator -->
                    <div class="step-indicator">
                        <div class="step active">
                            <div class="step-number">1</div>
                            <div class="step-label">Personal Info</div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-label">Details & Documents</div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-label">Payment</div>
                        </div>
                    </div>

                    <form action="{{route('page.application.submit')}}" method="POST" id="rentalApplicationForm" enctype="multipart/form-data" novalidate>
                        @csrf
                        <!-- Step 1: Personal Information -->
                        <div class="form-step" id="step1">
                            <div class="rental-header">
                                <img src="https://rentnowusa.us/wp-content/uploads/2024/10/Housing-Rental-USA-1-1.png" alt="Logo" class="img-fluid mb-3" style="max-width: 150px;">
                                <h1 class="h2">Welcome!</h1>
                                <p class="mb-0">
                                    <strong>You are applying to rent:</strong><br>
                                    1. Each resident over the age of 18 must submit a separate rental application.<br>
                                    2. In addition to this rental application, you will also be required to provide a copy of a valid form of identification and proof of income.
                                </p>
                            </div>

                            <div class="dashboard-wraper form-submit">
                                <h4>Personal Information</h4><hr>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="moveInDate" class="form-label required-label">Desired Move-in Date</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" name="move_in_date" class="form-control datepicker" id="moveInDate" placeholder="DD/MM/YYYY" required>
                                        </div>
                                        <div class="error-message" id="moveInDateError">Please select a move-in date</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label class="form-label required-label">Application Type</label>
                                        <div>
                                            <div class="form-check form-check mb-2">
                                                <input class="form-check-input" type="radio" name="application_type" id="tenantType" value="tenant" checked required>
                                                <label class="form-check-label" for="tenantType">
                                                    I am applying as a tenant. (I will be living on the property.)
                                                </label>
                                            </div>
                                            <div class="form-check form-check mb-2">
                                                <input class="form-check-input" type="radio" name="application_type" id="guarantorType" value="guarantor" required>
                                                <label class="form-check-label" for="guarantorType">
                                                    I am applying as a guarantor/co-signer for another applicant. (I will not be living on the property.)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="error-message" id="applicationTypeError">Please select an application type</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="fullName" class="form-label required-label">Full Name</label>
                                        <input type="text" name="full_name" class="form-control" id="fullName" placeholder="Your full name" required>
                                        <div class="error-message" id="fullNameError">Please enter your full name</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="email" class="form-label required-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="E.g. john@doe.com" required>
                                        <div class="error-message" id="emailError">Please enter a valid email address</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label required-label">Phone/Mobile</label>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="Your phone number" required>
                                        <div class="error-message" id="phoneError">Please enter your phone number</div>
                                    </div>
                                </div>
                            </div>

                            <div class="rental-header">
                                <h1 class="h2">Address Info</h1>
                            </div>

                            <div class="dashboard-wraper form-submit">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="currentAddress" class="form-label required-label">Current Address</label>
                                        <input type="text" name="current_address" class="form-control" id="currentAddress" placeholder="Your current address" required>
                                        <div class="error-message" id="currentAddressError">Please enter your current address</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="city" class="form-label required-label">City</label>
                                        <input type="text" name="city" class="form-control" id="city" placeholder="City" required>
                                        <div class="error-message" id="cityError">Please enter your city</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="state" class="form-label required-label">State/Province</label>
                                        <select class="form-select select2" name="state" id="state" required>
                                            <option value="">Please Select</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->name }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message" id="stateError">Please enter your state</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="zipCode" class="form-label required-label">ZIP / Postal</label>
                                        <input type="text" name="zip_code" class="form-control" id="zipCode" placeholder="ZIP / Postal" required>
                                        <div class="error-message" id="zipCodeError">Please enter your ZIP code</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="country" class="form-label required-label">Country</label>
                                        <select class="form-select select2" name="country" id="country" required>
                                            <option value="United States" selected>United States (US)</option>
                                            {{-- <option value="">Select country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->country_name }}">{{ $country->country_name . ' ('. $country->country_code .')' }}</option>
                                            @endforeach --}}
                                        </select>
                                        <div class="error-message" id="countryError">Please select your country</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="citizenship" class="form-label required-label">Are You US Citizenship?</label>
                                        <select class="form-select select2" name="citizenship" id="citizenship" required>
                                            <option value="">Please Select</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="error-message" id="citizenshipError">Please select an option</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <div></div> <!-- Empty div for spacing -->
                                <button type="button" class="btn btn-primary btn-next" data-next="step2" id="step1Next">
                                    Next <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Additional Details & Documents -->
                        <div class="form-step d-none" id="step2">
                            <div class="dashboard-wraper form-submit">
                                <h3>Additional Details</h3>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label required-label">Date Of Birth</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="text" name="date_of_birth" class="form-control datepicker" id="dob" placeholder="DD/MM/YYYY" required>
                                        </div>
                                        <div class="error-message" id="dobError">Please enter your date of birth</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="monthlyIncome" class="form-label required-label">Monthly Income</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-white">$</span>
                                            <input type="text" name="monthly_income" class="form-control" id="monthlyIncome" placeholder="Monthly income" required>
                                        </div>
                                        <div class="error-message" id="monthlyIncomeError">Please enter your monthly income</div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="governmentId" class="form-label">Government Issued ID</label>
                                        <input type="text" name="government_id" class="form-control" id="governmentId" placeholder="Government ID">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="issuingState" class="form-label required-label">Issuing State/Territory</label>
                                        <input type="text" name="issuing_state" class="form-control" id="issuingState" placeholder="State" required>
                                        <div class="error-message" id="issuingStateError">Please enter the issuing state</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="ssn" class="form-label required-label">Social Security Number (or ITIN)</label>
                                        <input type="text" name="ssn" class="form-control" id="ssn" placeholder="SSN or ITIN" required>
                                        <div class="error-message" id="ssnError">Please enter your SSN or ITIN</div>
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-wraper form-submit mt-4">
                                <h3 class="text-center mb-4">Attach Required Documents</h3>

                                <div class="alert alert-info">
                                    <p class="mb-2"><strong>Please ensure your ID meets these requirements:</strong></p>
                                    <ul class="mb-0 ps-3">
                                        <li>Full name and date of birth must be visible</li>
                                        <li>Document must not be expired</li>
                                        <li>Document must not be blurry</li>
                                        <li>Entire ID must be shown (not cropped or covered)</li>
                                        <li>Only government-issued ID accepted (passport, driver's license, national ID)</li>
                                    </ul>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6 col-lg-3 mb-3">
                                        <div class="file-upload-container" id="idFrontContainer">
                                            <div class="preview-box" id="idFrontPreview">
                                                <i class="fas fa-id-card fa-2x mb-2 text-primary"></i>
                                                <h6>Photo ID Front Side</h6>
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="progress mt-2 mb-0" style="height: 5px; display: none;">
                                                <div id="image_bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                                            </div>
                                            <input type="file" name="id_front_path" class="d-none" id="idFront" required accept="image/*,.pdf">
                                            <label for="idFront" class="btn btn-sm btn-outline-primary mt-2">Choose File</label>
                                            <div class="small text-muted mt-1 file-name">No file chosen</div>
                                            <div class="file-error" id="idFrontError">Please upload the front side of your ID</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-3 mb-3">
                                        <div class="file-upload-container" id="idBackContainer">
                                            <div class="preview-box" id="idBackPreview">
                                                <i class="fas fa-id-card fa-2x mb-2 text-primary"></i>
                                                <h6>Photo ID Back Side</h6>
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="progress mt-2 mb-0" style="height: 5px; display: none;">
                                                <div id="image_bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                                            </div>
                                            <input type="file" name="id_back_path" class="d-none" id="idBack" required accept="image/*,.pdf">
                                            <label for="idBack" class="btn btn-sm btn-outline-primary mt-2">Choose File</label>
                                            <div class="small text-muted mt-1 file-name">No file chosen</div>
                                            <div class="file-error" id="idBackError">Please upload the back side of your ID</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-3 mb-3">
                                        <div class="file-upload-container" id="selfieContainer">
                                            <div class="preview-box" id="selfiePreview">
                                                <i class="fas fa-user fa-2x mb-2 text-primary"></i>
                                                <h6>Your Clear Selfie</h6>
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="progress mt-2 mb-0" style="height: 5px; display: none;">
                                                <div id="image_bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                                            </div>
                                            <input type="file" name="selfie_path" class="d-none" id="selfie" required accept="image/*">
                                            <label for="selfie" class="btn btn-sm btn-outline-primary mt-2">Choose File</label>
                                            <div class="small text-muted mt-1 file-name">No file chosen</div>
                                            <div class="file-error" id="selfieError">Please upload a clear selfie</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-3 mb-3">
                                        <div class="file-upload-container" id="incomeProofContainer">
                                            <div class="preview-box" id="incomeProofPreview">
                                                <i class="fas fa-file-invoice-dollar fa-2x mb-2 text-primary"></i>
                                                <h6>Proof of Income</h6>
                                            </div>
                                            <!-- Progress Bar -->
                                            <div class="progress mt-2 mb-0" style="height: 5px; display: none;">
                                                <div id="image_bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                                            </div>
                                            <input type="file" name="income_path" class="d-none" id="incomeProof" required accept="image/*,.pdf">
                                            <label for="incomeProof" class="btn btn-sm btn-outline-primary mt-2">Choose File</label>
                                            <div class="small text-muted mt-1 file-name">No file chosen</div>
                                            <div class="file-error" id="incomeProofError">Please upload proof of income</div>
                                        </div>
                                        <small>Recent pay stubs, bank statements, or tax returns</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-primary btn-prev" data-prev="step1">
                                    <i class="fas fa-arrow-left me-2"></i> Previous
                                </button>
                                <button type="button" class="btn btn-primary btn-next" data-next="step3" id="step2Next">
                                    Next <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Payment -->
                        <div class="form-step d-none" id="step3">
                            <div class="payment-section row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="card border-0 shadow-sm">
                                        <div class="card-body text-center p-4">
                                            <h4 class="card-title mb-4">Application Fee: <span class="text-primary">$99</span></h4>
                                            <hr>
                                            @if ($paymentMethods->isNotEmpty())
                                                <div class="mb-4">
                                                @foreach ($paymentMethods as $method)
                                                    <div class="payment-method mb-4 text-center">
                                                        <img src="{{ asset($method->logo) }}" alt="{{ $method->name }}" class="img-fluid mb-3" style="max-width: 200px;">
                                                        @if($method->qr_code)
                                                            <div class="mt-3">
                                                                <img src="{{ asset($method->qr_code) }}" alt="{{ $method->name }} QR" class="img-fluid mb-2" style="max-width: 150px;">
                                                                <p class="small text-muted">{{ $method->instructions }}</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="mb-4">
                                                <img src="https://rentnowusa.us/wp-content/uploads/2025/06/chime.png" alt="Chime" class="img-fluid mb-3" style="max-width: 200px;">
                                                <div class="mt-3">
                                                    <img src="https://rentnowusa.us/wp-content/uploads/2025/07/WhatsApp-Image-2025-07-02-at-7.40.11-PM.jpeg" alt="QR Code" class="img-fluid mb-2" style="max-width: 150px;">
                                                    <p class="small text-muted">Scan QR to Pay</p>
                                                </div>
                                            </div>
                                            @endif

                                            <p class="card-text">
                                                The application fee of <strong>$99</strong> must be paid before your visit.
                                                This amount is <span class="text-success fw-bold">fully refundable</span>.
                                            </p>

                                            <p class="card-text mt-3">
                                                Contact us: <a href="mailto:support@rentnowusa.us" class="text-decoration-none">support@rentnowusa.us</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 mx-auto">
                                    <div class="file-upload-container mt-4" id="paymentProofContainer">
                                        <div class="preview-box" id="paymentProofPreview">
                                            <i class="fas fa-receipt fa-2x mb-2 text-primary"></i>
                                            <h5>Upload Payment Confirmation</h5>
                                            <p class="small text-muted">Please upload a screenshot of your payment confirmation</p>
                                        </div>
                                        <!-- Progress Bar -->
                                        <div class="progress mt-2 mb-0" style="height: 5px; display: none;">
                                            <div id="image_bar" class="progress-bar" role="progressbar" style="width:0%"></div>
                                        </div>
                                        <input type="file" name="payment_path" class="d-none" id="paymentProof" required accept="image/*,.pdf">
                                        <label for="paymentProof" class="btn btn-outline-primary mt-2">Choose File</label>
                                        <div class="small text-muted mt-1 file-name">No file chosen</div>
                                        <div class="file-error" id="paymentProofError">Please upload payment confirmation</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-primary btn-prev" data-prev="step2">
                                    <i class="fas fa-arrow-left me-2"></i> Previous
                                </button>
                                <button type="submit" class="btn btn-success" id="submitBtn">Submit Application <i class="fas fa-check ms-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(function () {
            // Init Select2 & Flatpickr
            $('.select2').select2({ placeholder: "Please Select", allowClear: true, width: '100%' });
            flatpickr(".datepicker", { dateFormat: "d/m/Y", allowInput: true, altInput: true, altFormat: "F j, Y", defaultDate: "today" });

            // Step navigation
            $('.btn-next, .btn-prev').on('click', function () {
                let target = $(this).data('next') || $(this).data('prev');
                if ($(this).hasClass('btn-next') && !validateStep($(this).closest('.form-step').attr('id'))) return;
                $('.form-step').addClass('d-none'); $('#' + target).removeClass('d-none'); updateSteps(target);
            });

            // File input display
            $('input[type="file"]').on('change', function () {
                let ok = this.files.length, name = ok ? this.files[0].name : "No file chosen";
                $(this).siblings('.file-name').text(name).end().closest('.file-upload-container').toggleClass('has-error', !ok);
                $(this).siblings('.file-error').toggle(!ok);
            });

            // Validate on blur/change
            $('input, select').on('blur change', function () { validateField($(this)); });

            // Submit form
            $('#rentalApplicationForm').on('submit', function (e) {
                e.preventDefault();
                if (validateStep('step1') && validateStep('step2') && validateStep('step3')) {
                    const formData = new FormData(this);
                    $('#submitBtn').html('<span class="spinner-border spinner-border-sm"></span> Submitting...').prop('disabled', true);
                    $.ajax({
                        url: this.action, type: 'POST', data: formData, processData: false, contentType: false,
                        success: () => { this.reset(); window.location.href = "{{ route('page.application.success') }}"; },
                        error: () => { alert("There was an error submitting your application. Please try again."); },
                        complete: () => $('#submitBtn').html('Submit Application <i class="fas fa-check ms-2"></i>').prop('disabled', false)
                    });
                } else {
                    ['step1','step2','step3'].some(id => !validateStep(id) && ($('.form-step').addClass('d-none'),$('#'+id).removeClass('d-none'),updateSteps(id),1));
                    alert("Please fix the errors in the form before submitting.");
                }
            });

            // --- Helpers ---
            function validateStep(id) {
                let valid = true, firstInvalid = null;
                $('#' + id).find('input[required], select[required]').each(function () {
                    let $f = $(this);
                    if (!validateField($f)) { valid = false; if (!firstInvalid) firstInvalid = $f; }
                });
                if (firstInvalid) setTimeout(() => { firstInvalid.focus(); $('html, body').animate({ scrollTop: firstInvalid.offset().top - 100 }, 300); }, 100);
                return valid;
            }

            function validateField($f) {
                let val = $f.val()?.trim(), err = $('#' + $f.attr('id') + 'Error'), ok = true;
                if ($f.is('[type=radio]')) ok = !!$(`input[name="${$f.attr('name')}"]:checked`).length, $f.closest('.form-check').toggleClass('has-error', !ok);
                else if ($f.is('[type=file]')) ok = $f[0].files.length > 0, $f.closest('.file-upload-container').toggleClass('has-error', !ok);
                else if ($f.is('[type=email]')) ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val), $f.toggleClass('has-error', !ok);
                else ok = !!val, $f.toggleClass('has-error', !ok);
                if (err.length) err.toggle(!ok);
                return ok;
            }

            function updateSteps(step) {
                $('.step').removeClass('active completed');
                if (step === 'step1') $('.step').eq(0).addClass('active');
                if (step === 'step2') $('.step').eq(0).addClass('completed').end().eq(1).addClass('active');
                if (step === 'step3') $('.step').eq(0).addClass('completed').end().eq(1).addClass('completed').end().eq(2).addClass('active');
            }
        });
    </script>

    <script>
        // File input display + preview
        $('input[type="file"]').on('change', function () {
            let file = this.files[0],
                $c = $(this).closest('.file-upload-container'),
                $p = $c.find('.preview-box'),
                $n = $c.find('.file-name'),
                $b = $c.find('.progress-bar'),
                $progress = $c.find('.progress');

            const defaults = {
                idFrontPreview: `<i class="fas fa-id-card fa-2x mb-2 text-primary"></i><h6>Photo ID Front Side</h6>`,
                idBackPreview: `<i class="fas fa-id-card fa-2x mb-2 text-primary"></i><h6>Photo ID Back Side</h6>`,
                selfiePreview: `<i class="fas fa-user fa-2x mb-2 text-primary"></i><h6>Your Clear Selfie</h6>`,
                incomeProofPreview: `<i class="fas fa-file-invoice-dollar fa-2x mb-2 text-primary"></i><h6>Proof of Income</h6>`,
                paymentProofPreview: `<i class="fas fa-receipt fa-2x mb-2 text-primary"></i><h6>Proof of Payment</h6>`
            };

            if (file) {
                $n.text(file.name);
                $progress.show();
                // Animate progress
                let w = 0; $b.css('width','0%');
                let id = setInterval(() => (w>=100?clearInterval(id):$b.css('width', ++w+'%')), 15);

                $p.html(file.type.startsWith('image/')
                    ? `<img src="${URL.createObjectURL(file)}" class="img-fluid rounded shadow-sm" style="max-height:120px;"/>`
                    : file.type==='application/pdf'
                        ? `<i class="fas fa-file-pdf fa-3x text-danger"></i><p class="mb-0 small">PDF Uploaded</p>`
                        : defaults[$p.attr('id')] || '');
            } else {
                $n.text("No file chosen");
                $progress.hide();
                $b.css('width','0%');
                $p.html(defaults[$p.attr('id')] || '');
            }
        });
    </script>
    @endpush


@endsection
</x-frontend-layout>
