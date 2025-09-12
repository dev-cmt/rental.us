<x-frontend-layout>
@section('title', 'Contact Us')
@section('breadcrumb')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">Contact Us</h2>
                    <span class="ipn-subtitle">Get in touch with us</span>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
@endsection
@section('content')
    <!-- ============================ Contact List Start ================================== -->
    <section>
        <div class="container">
            <!-- row Start -->
            <div class="row">
                <div class="col-lg-7 col-md-7">
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

                    <form action="{{ route('page.contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control simple" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control simple" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control simple" value="{{ old('subject') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control simple" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-main px-5 rounded" type="submit">Submit Request</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-5 col-md-5">
                    <div class="contact-info">
                        <h2>Get In Touch</h2>
                        <p>{{ $contactInfo->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}</p>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Reach Us</h4>
                                {{ $contactInfo->address ?? '' }}
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="fa-solid fa-envelope-circle-check"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Drop A Mail</h4>
                                {{ $contactInfo->email ?? '' }} <br>
                                {{ $contactInfo->email2 ?? '' }}
                            </div>
                        </div>

                        <div class="cn-info-detail">
                            <div class="cn-info-icon">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="cn-info-content">
                                <h4 class="cn-info-title">Call Us</h4>
                                {{ $contactInfo->phone ?? '' }} <br>
                                {{ $contactInfo->phone2 ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
    </section>
    <!-- ============================ Contact List End ================================== -->
@endsection
</x-frontend-layout>
