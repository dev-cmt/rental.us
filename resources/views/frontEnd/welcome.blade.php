<x-frontend-layout>
@section('title', 'Home')
@section('breadcrumb')
    <!-- ============================ Hero Banner Start ================================== -->
    <div class="light-bg hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                    @if($heroBanner->badge_text ?? false)
                    <div class="d-flex align-items-center justify-content-start mb-2">
                        <div class="label rounded-pill bg-white text-dark d-flex align-items-center justify-content-center px-2 py-2 pe-3">
                            <span class="label {{ $heroBanner->badge_color ?? 'bg-green' }} rounded-pill text-uppercase me-2">New</span> {{ $heroBanner->badge_text ?? 'Welcome' }}
                        </div>
                    </div>
                    @endif

                    <h2>{!! nl2br(e(($heroBanner->title ?? 'Find Your Dream House') . "\nIn")) !!} <span class="element" data-elements="{{ implode(',', $heroBanner->search_locations ?? ['California', 'Denver', 'Las Vegas', 'San Antonio', 'San Francisco', 'Los Angeles', 'New Orleans', 'San Diego']) }}"></span></h2>
                    <p class="small">{{ $heroBanner->description ?? 'Find homes in 80+ different countries represented by 700 leading member brokerages.' }}</p>

                    <!-- Search Form -->
                    <div class="full-search-2 eclip-search italian-search hero-search-radius mt-5">
                        <div class="hero-search-content">
                            <form action="{{ route('page.properties') }}" method="GET">
                                <div class="row">

                                    {{-- <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 b-r">
                                        <div class="form-group">
                                            <div class="choose-propert-type">
                                                <ul>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" id="typbuy" name="typeprt" value="buy" {{ request('typeprt') == 'buy' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="typbuy">Buy</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" id="typrent" name="typeprt" value="rent" {{ request('typeprt') == 'rent' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="typrent">Rent</label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 px-xl-0 px-lg-0 px-md-0">
                                        <div class="form-group borders ps-2">
                                            <div class="position-relative">
                                                <input type="text" name="location" class="form-control border-0 ps-5" placeholder="Search for a location" value="{{ request('location') }}">
                                                <div class="position-absolute top-50 start-0 translate-middle-y ms-2">
                                                    <span class="svg-icon text-main svg-icon-2hx">
                                                        <svg width="25" height="25" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor"></path>
                                                            <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark full-width">Search</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                    @if($heroBanner->popular_searches ?? false)
                    <div class="searches-lists">
                        <ul>
                            <li><span>Popular Searches:</span></li>
                            @foreach($heroBanner->popular_searches as $search)
                            <li><a href="JavaScript:Void(0);">{{ $search }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                    <div class="">
                        @if(isset($heroBanner) && $heroBanner->image)
                            <img src="{{ asset($heroBanner->image) }}" class="img-fluid" alt="Hero Banner" />
                        @else
                            <img src="{{ asset('uploads/side-city-1.png')}}" class="img-fluid" alt="Default Hero Banner" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->
@endsection
@section('content')
    <!-- ============================ Category Start ================================== -->
    @if (!empty($categories) && $categories->isNotEmpty())
    <section>
        <div class="container">

            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <div class="sec-heading mb-4 mss">
                        <h2>Choose Property Type</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center gx-3 gy-3">
                @foreach ($categories as $category)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="classical-cats-wrap style_2 shadows">
                        <a href="{{ route('page.properties', ['category' => $category->id]) }}" class="classical-cats-boxs bg-white rounded-4 px-3 py-4">
                            <div class="classical-cats-icon circle bg-light-info text-main fs-2">
                                <i class="{{ $category->icon ?? 'fa-solid fa-house-laptop'}}"></i>
                            </div>
                            <div class="classical-cats-wrap-content">
                                <h4>{{$category->category_name}}</h4>
                                <p>{{ $category->properties_count }} Properties</p>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    @endif
    <!-- ================================ Category End ======================================== -->

    <!-- ================================ All Property ========================================= -->
    @if (!empty($rentProperties) && $rentProperties->isNotEmpty())
    <section class="gray-simple">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10 text-center">
                    <div class="sec-heading mss">
                        <h2>Featured Property For Rent</h2>
                        <p>At vero eos et accusamus dignissimos ducimus</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                @foreach ($rentProperties as $property)
                    <!-- Single Property -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        @include('frontEnd.include.__property_grid', ['property' => $property])
                    </div>
                    <!-- End Single Property -->
                @endforeach
            </div>

            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center mt-5">
                    <a href="listings-list-with-sidebar.html" class="btn btn-main px-md-5 rounded">Browse More
                        Properties</a>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!-- ============================ All Featured Property ================================== -->

    <!-- ============================ Achievement Start ================================== -->
    @if (!empty($achievements) && $achievements->isNotEmpty())
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center mb-4">
                        <h2>Achievement</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center justify-content-center g-4">
                @foreach($achievements as $achievement)
                <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                    <div class="achievement-wrap">
                        <div class="achievement-content">
                            <h2 class="fs-1"><span class="ctr" data-count="{{ $achievement->count }}">0</span>{{ $achievement->suffix }}</h2>
                            <p>{{ $achievement->title }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- ============================ Achievement End ================================== -->

    <!-- ============================ Service Start ================================== -->
    @if (!empty($services) && $services->isNotEmpty())
    <section class="bg-light">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center">
                        <h2>What Are You Looking For?</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                @php
                    $colorClasses = [
                        ['bg' => 'f-light-success', 'text' => 'text-success'],
                        ['bg' => 'f-light-warning', 'text' => 'text-warning'],
                        ['bg' => 'f-light-purple', 'text' => 'text-purple'],
                        ['bg' => 'f-light-info', 'text' => 'text-info'],
                    ];
                @endphp

                @foreach ($services as $key => $service)
                    @php
                        $color = $colorClasses[$key % count($colorClasses)];
                    @endphp
                    <div class="col-lg-4 col-md-4">
                        <div class="middle-icon-features-item">
                            <div class="icon-features-wrap">
                                <div class="middle-icon-large-features-box {{ $color['bg'] }}">
                                    <span class="svg-icon {{ $color['text'] }} svg-icon-2hx">
                                        <i class="{{ $service->icon }}"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="middle-icon-features-content">
                                <h4>{{ $service->title }}</h4>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    @endif
    <!-- ============================ Service End ================================== -->

    <!-- ============================ All Property ================================== -->
    @if (!empty($saleProperties) && $saleProperties->isNotEmpty())
    <section>
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center">
                        <h2>Featured Property For Sale</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row list-layout">
                @foreach ($saleProperties as $property)
                <!-- Single Property Start -->
                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                    <div class="border">
                        @include('frontEnd.include.__property_list', ['property' => $property])
                    </div>
                </div>
                <!-- Single Property End -->
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center mt-4">
                    <a href="{{route('page.properties')}}" class="btn btn-main px-lg-5 rounded">Browse More Properties</a>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!-- ============================ All Featured Property ================================== -->

    <!-- ============================ Smart Testimonials ================================== -->
    @if (!empty($testimonials) && $testimonials->isNotEmpty())
    <section class="gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10 text-center">
                    <div class="sec-heading center">
                        <h2>Good Reviews by Customers</h2>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
                            voluptatum deleniti atque corrupti quos dolores</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="smart-textimonials smart-center" id="smart-textimonials">
                        @foreach($testimonials as $testimonial)
                        <!-- Single Item -->
                        <div class="item">
                            <div class="item-box">
                                <div class="smart-tes-author">
                                    <div class="st-author-box">
                                        <div class="st-author-thumb">
                                            <div class="quotes bg-main"><i class="fa-solid fa-quote-left"></i></div>
                                            @if($testimonial->image)
                                                <img src="{{ asset($testimonial->image) }}" class="img-fluid" alt="{{ $testimonial->client_name }}" />
                                            @else
                                                <img src="{{ asset('frontEnd/img/user-3.png') }}" class="img-fluid" alt="{{ $testimonial->client_name }}" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="smart-tes-content">
                                    <p>{{ $testimonial->content }}</p>
                                </div>

                                <div class="st-author-info">
                                    <h4 class="st-author-title">{{ $testimonial->client_name }}</h4>
                                    <span class="st-author-subtitle">{{ $testimonial->position }} Of {{ $testimonial->company }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- ============================ Smart Testimonials End ================================== -->

    @push('js')
        <script>
            $(function() {
                let animated = false;

                $(window).on('scroll', function() {
                    if (animated || !$('.achievement-wrap').visible(true)) return;

                    animated = true;
                    $('.ctr').each(function() {
                        $(this).animate({ num: $(this).data('count') }, {
                            duration: 1500,
                            step: function(now) { $(this).text(Math.ceil(now)); }
                        });
                    });
                }).trigger('scroll');
            });

            // Simple visible check
            $.fn.visible = function() {
                const win = $(window), elem = $(this);
                return elem.offset().top < win.scrollTop() + win.height();
            };
            </script>
    @endpush

@endsection


</x-frontend-layout>
