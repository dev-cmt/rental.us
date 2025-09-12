<x-frontend-layout>
@section('title', 'Appointment Success')
@push('css')

@endpush
    @section('breadcrumb')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h2 class="ipt-title">Appointment</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
@endsection

@section('content')
    @if (!empty($applicationSuccess))
    <section class="middle">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="text-center">
                        <div class="mb-4">
                            <a href="{{$applicationSuccess->url ?? '#' }}" target="_blank"><img src="{{ asset($applicationSuccess->image) }}" alt=""></a>
                        </div>
                        <h2 class="mb-3">{{$applicationSuccess->title ?? '' }}</h2>
                        <p>{{$applicationSuccess->description ?? '' }}</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
</x-frontend-layout>
