<x-frontend-layout>
@section('title', 'Home')
@section('breadcrumb')
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <h2 class="ipt-title">About Us</h2>
                    <span class="ipn-subtitle">Who we are & our mission</span>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->
@endsection
@section('content')
    <!-- ============================ Our Story Start ================================== -->
    <section>
        <div class="container">
            @php
                $story = \App\Models\Story::where('status', 'active')->first();
            @endphp

            @if($story)
            <!-- row Start -->
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset($story->image ?: 'frontEnd/img/sb.png') }}" class="img-fluid" alt="Our Story" />
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="story-wrap explore-content">

                        <h2>{{ $story->title }}</h2>
                        <p>{{ $story->content }}</p>

                        @if($story->content_second)
                        <p>{{ $story->content_second }}</p>
                        @endif

                    </div>
                </div>

            </div>
            <!-- /row -->
            @else
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p>Our story content is coming soon...</p>
                </div>
            </div>
            @endif

        </div>
    </section>
    <!-- ============================ Our Story End ================================== -->

    <!-- ================= Our Team================= -->
    <section class="gray-bg">
        <div class="container">
            @php
                $teams = \App\Models\Team::active()->ordered()->get();
            @endphp

            @if($teams->count() > 0)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading center">
                        <h2>Meet Our Team</h2>
                        <p>Professional & Dedicated Team</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="team-slide item-slide">
                        @foreach($teams as $team)
                        <!-- Single Team Member -->
                        <div class="single-team">
                            <div class="team-grid">
                                <div class="teamgrid-user">
                                    <img src="{{ asset($team->image ?: 'frontEnd/img/team-placeholder.jpg') }}" alt="{{ $team->name }}" class="img-fluid" />
                                </div>

                                <div class="teamgrid-content">
                                    <h4>{{ $team->name }}</h4>
                                    <span>{{ $team->position }}</span>
                                    {{-- @if($team->bio)
                                    <p class="team-bio">{{ Str::limit($team->bio, 100) }}</p>
                                    @endif --}}
                                </div>

                                <div class="teamgrid-social">
                                    <ul>
                                        @if($team->facebook)
                                        <li><a href="{{ $team->facebook }}" target="_blank" class="f-cl"><i class="fa-brands fa-facebook"></i></a></li>
                                        @endif
                                        @if($team->twitter)
                                        <li><a href="{{ $team->twitter }}" target="_blank" class="t-cl"><i class="fa-brands fa-twitter"></i></a></li>
                                        @endif
                                        @if($team->instagram)
                                        <li><a href="{{ $team->instagram }}" target="_blank" class="i-cl"><i class="fa-brands fa-instagram"></i></a></li>
                                        @endif
                                        @if($team->linkedin)
                                        <li><a href="{{ $team->linkedin }}" target="_blank" class="l-cl"><i class="fa-brands fa-linkedin"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted">Team members is coming soon...</p>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- =============================== Our Team ================================== -->

    <!-- ================= Our Mission ================= -->
    <section>
        <div class="container">
            @php
                $mission = \App\Models\Mission::getActive();
            @endphp

            @if($mission)
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="sec-heading center">
                        <h2>Our Mission & Work Process</h2>
                        <p>Professional & Dedicated Team</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    @foreach($mission->mission_items as $item)
                        @if($item['status'] == 'active')
                        <div class="icon-mi-left">
                            <i class="{{ $item['icon_class'] }} text-main"></i>
                            <div class="icon-mi-left-content">
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>

                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset($mission->image_path) }}" class="img-fluid" alt="Our Mission" />
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-muted">Mission content is coming soon...</p>
                </div>
            </div>
            @endif
        </div>
    </section>
    <!-- ================= Our Mission ================= -->
@endsection
</x-frontend-layout>
