<x-frontend-layout>
@section('title', 'Home')
@section('breadcrumb')
    <!-- ============================ Hero Banner  Start================================== -->
    <div class="featured_slick_gallery gray">
        <div class="featured_slick_gallery-slide">
            @foreach ($property->images as $item)
                <div class="featured_slick_padd"><a href="{{asset($item->image_path)}}" class="mfp-gallery"><img src="{{asset($item->image_path)}}" class="img-fluid mx-auto" alt="" /></a></div>
            @endforeach
        </div>
        {{-- <a href="JavaScript:Void(0);" class="btn-view-pic">View photos</a> --}}
    </div>
    <!-- ============================ Hero Banner End ================================== -->
@endsection
@section('content')

    <section class="gray-simple rtl p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-md-12">
                    <div class="property_block_wrap style-3">
                        <div class="ft-flex-thumb">
                            <img src="{{ asset($property->images->where('is_default', true)->first()->image_path ?? '') }}" class="img-fluid w-100 rounded mb-2" style="height: 180px; object-fit: cover;" alt="{{ $property->title }}">
                        </div>

                        <div class="pbw-flex">
                            <div class="prt-detail-title-desc lstng-pg-title-desc">
                                <span class="label text-light bg-green">
                                    {{ ucfirst($property->property_status) }}
                                </span>

                                <h3 class="mt-2">{{ $property->title }}</h3>

                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $property->address }}, {{ $property->city }}, {{ $property->state_county }}
                                </span>

                                <h3 class="prt-price-fix text-main">
                                    ${{ number_format($property->price, 2) }}
                                    @if($property->property_status == 'rent')
                                        <sub>/month</sub>
                                    @endif
                                </h3>

                                <div class="list-fx-features">
                                    @if($property->bed_room)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-bed me-1"></i> {{ $property->bed_room }} Beds
                                        </div>
                                    @endif

                                    @if($property->bath_room)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-bath me-1"></i> {{ $property->bath_room }} Bath
                                        </div>
                                    @endif

                                    @if($property->dining_room)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-utensils me-1"></i> {{ $property->dining_room }} Dining
                                        </div>
                                    @endif

                                    @if($property->balcony)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-archway me-1"></i> {{ $property->balcony }} Balcony
                                        </div>
                                    @endif

                                    @if($property->area_size)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-ruler-combined me-1"></i> {{ $property->area_size }} sqft
                                        </div>
                                    @endif
                                    @if($property->dimension)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-object-ungroup me-1"></i> {{ $property->dimension }} m
                                        </div>
                                    @endif

                                    @if($property->built_year)
                                        <div class="listing-card-info-icon">
                                            <i class="fas fa-calendar-alt me-1"></i> Built {{ $property->built_year }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Property Detail Start ================================== -->
    <section class="gray-simple pt-4">
        <div class="container">
            <div class="row">
                <!-- property main detail -->
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">
                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Description</h4></a>
                        </div>
                        <div id="clTwo" class="panel-collapse collapse show">
                            <div class="block-body">
                                {!! $property->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#amen"  data-bs-target="#clThree" aria-controls="clThree" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Ameneties</h4></a>
                        </div>

                        <div id="clThree" class="panel-collapse collapse show">
                            <div class="block-body">
                                <ul class="avl-features third color">
                                    @foreach($property->features as $feature)
                                        <li>{{ $feature->feature_name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#loca"  data-bs-target="#clSix" aria-controls="clSix" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Location</h4></a>
                        </div>

                        <div id="clSix" class="panel-collapse collapse">
                            <div class="block-body">
                                <div class="map-container">
                                    <style>
                                        .map-container iframe{
                                            width: 100%;
                                        }
                                    </style>
                                    {!! $property->location ?? '' !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#clSev"  data-bs-target="#clSev" aria-controls="clOne" href="javascript:void(0);" aria-expanded="true" class="collapsed"><h4 class="property_block_title">Gallery</h4></a>
                        </div>

                        <div id="clSev" class="panel-collapse collapse">
                            <div class="block-body">
                                <ul class="list-gallery-inline">
                                    @foreach ($property->images as $item)
                                    <li>
                                        <a href="{{asset($item->image_path)}}" class="mfp-gallery"><img src="{{asset($item->image_path)}}" class="img-fluid mx-auto" alt="" /></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                    {{-- <!-- All over Review -->
                    <div class="rating-overview">
                        <div class="rating-overview-box">
                            <span class="rating-overview-box-total">4.2</span>
                            <span class="rating-overview-box-percent">out of 5.0</span>
                            <div class="star-rating" data-rating="5">
                                <i class="fas fa-star fs-xs mx-1"></i><i class="fas fa-star fs-xs mx-1"></i><i class="fas fa-star fs-xs mx-1"></i><i class="fas fa-star fs-xs mx-1"></i><i class="fas fa-star fs-xs mx-1"></i>
                            </div>
                        </div>

                        <div class="rating-bars">
                                <div class="rating-bars-item">
                                    <span class="rating-bars-name">Service</span>
                                    <span class="rating-bars-inner">
                                        <span class="rating-bars-rating high" data-rating="4.7">
                                            <span class="rating-bars-rating-inner" style="width: 85%;"></span>
                                        </span>
                                        <strong>4.7</strong>
                                    </span>
                                </div>
                                <div class="rating-bars-item">
                                    <span class="rating-bars-name">Value for Money</span>
                                    <span class="rating-bars-inner">
                                        <span class="rating-bars-rating good" data-rating="3.9">
                                            <span class="rating-bars-rating-inner" style="width: 75%;"></span>
                                        </span>
                                        <strong>3.9</strong>
                                    </span>
                                </div>
                                <div class="rating-bars-item">
                                    <span class="rating-bars-name">Location</span>
                                    <span class="rating-bars-inner">
                                        <span class="rating-bars-rating mid" data-rating="3.2">
                                            <span class="rating-bars-rating-inner" style="width: 52.2%;"></span>
                                        </span>
                                        <strong>3.2</strong>
                                    </span>
                                </div>
                                <div class="rating-bars-item">
                                    <span class="rating-bars-name">Cleanliness</span>
                                    <span class="rating-bars-inner">
                                        <span class="rating-bars-rating poor" data-rating="2.0">
                                            <span class="rating-bars-rating-inner" style="width:20%;"></span>
                                        </span>
                                        <strong>2.0</strong>
                                    </span>
                                </div>
                        </div>
                    </div>
                    <!-- All over Review -->

                    <!-- Single Reviews Block -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#rev"  data-bs-target="#clEight" aria-controls="clEight" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">102 Reviews</h4></a>
                        </div>

                        <div id="clEight" class="panel-collapse collapse show">
                            <div class="block-body">
                                <div class="author-review">
                                    <div class="comment-list">
                                        <ul>
                                            <li class="article_comments_wrap">
                                                <article>
                                                    <div class="article_comments_thumb">
                                                        <img src="assets/img/user-1.png" alt="">
                                                    </div>
                                                    <div class="comment-details">
                                                        <div class="comment-meta">
                                                            <div class="comment-left-meta">
                                                                <h4 class="author-name">Rosalina Kelian</h4>
                                                                <div class="comment-date">19th May 2018</div>
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                                                                perspiciatis unde omnis iste natus error.</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </li>
                                            <li class="article_comments_wrap">
                                                <article>
                                                    <div class="article_comments_thumb">
                                                        <img src="assets/img/user-5.png" alt="">
                                                    </div>
                                                    <div class="comment-details">
                                                        <div class="comment-meta">
                                                            <div class="comment-left-meta">
                                                                <h4 class="author-name">Rosalina Kelian</h4>
                                                                <div class="comment-date">19th May 2018</div>
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim laborumab.
                                                                perspiciatis unde omnis iste natus error.</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="reviews-checked text-main"><i class="fas fa-arrow-alt-circle-down mr-2"></i>See More Reviews</a>
                            </div>
                        </div>

                    </div>

                    <!-- Single Block Wrap -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#nearby" data-bs-target="#clNine" aria-controls="clNine" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Nearby</h4></a>
                        </div>

                        <div id="clNine" class="panel-collapse collapse show">
                            <div class="block-body">

                                <!-- Schools -->
                                <div class="nearby-wrap">
                                    <div class="nearby_header">
                                        <div class="nearby_header_first">
                                            <h5>Schools Around</h5>
                                        </div>
                                        <div class="nearby_header_last">
                                            <div class="nearby_powerd">
                                                Powerd by <img src="assets/img/edu.html" class="img-fluid" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="neary_section_list">

                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Green Iseland School<small>(3.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <small class="reviews-count">(421 Reviews)</small>
                                            </div>
                                        </div>

                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Ragni Intermediate College<small>(0.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star-half filled"></i>
                                                </div>
                                                <small class="reviews-count">(470 Reviews)</small>
                                            </div>
                                        </div>

                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Rose Wood main Scool<small>(0.47 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <small class="reviews-count">(204 Reviews)</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Hotel & Restaurant -->
                                <div class="nearby-wrap">
                                    <div class="nearby_header">
                                        <div class="nearby_header_first">
                                            <h5>Food Around</h5>
                                        </div>
                                        <div class="nearby_header_last">
                                            <div class="nearby_powerd">
                                                Powerd by <img src="assets/img/food.html" class="img-fluid" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="neary_section_list">

                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">The Rise hotel<small>(2.42 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                </div>
                                                <small class="reviews-count">(105 Reviews)</small>
                                            </div>
                                        </div>

                                        <div class="neary_section">
                                            <div class="neary_section_first">
                                                <h4 class="nearby_place_title">Blue Ocean Bar & Restaurant<small>(1.52 mi)</small></h4>
                                            </div>
                                            <div class="neary_section_last">
                                                <div class="nearby_place_rate">
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star filled"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <small class="reviews-count">(40 Reviews)</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Single Write a Review -->
                    <div class="property_block_wrap style-2">

                        <div class="property_block_wrap_header">
                            <a data-bs-toggle="collapse" data-parent="#comment" data-bs-target="#clTen" aria-controls="clTen" href="javascript:void(0);" aria-expanded="true"><h4 class="property_block_title">Write a Review</h4></a>
                        </div>

                        <div id="clTen" class="panel-collapse collapse show">
                            <div class="block-body">
                                <form class="form-submit">
                                    <!-- Review Ratings -->
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <h5>Property</h5>
                                                    <div class="rate-stars">
                                                        <input type="radio" id="property5" name="property" value="5" checked>
                                                        <label for="property5"></label>
                                                        <input type="radio" id="property4" name="property" value="4">
                                                        <label for="property4"></label>
                                                        <input type="radio" id="property3" name="property" value="3">
                                                        <label for="property3"></label>
                                                        <input type="radio" id="property2" name="property" value="2">
                                                        <label for="property2"></label>
                                                        <input type="radio" id="property1" name="property" value="1">
                                                        <label for="property1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <h5>Location</h5>
                                                    <div class="rate-stars">
                                                        <input type="radio" id="location5" name="location" value="5" checked>
                                                        <label for="location5"></label>
                                                        <input type="radio" id="location4" name="location" value="4">
                                                        <label for="location4"></label>
                                                        <input type="radio" id="location3" name="location" value="3">
                                                        <label for="location3"></label>
                                                        <input type="radio" id="location2" name="location" value="2">
                                                        <label for="location2"></label>
                                                        <input type="radio" id="location1" name="location" value="1">
                                                        <label for="location1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <h5>Value for money</h5>
                                                    <div class="rate-stars">
                                                        <input type="radio" id="value_for_money5" name="value_for_money" value="5" checked>
                                                        <label for="value_for_money5"></label>
                                                        <input type="radio" id="value_for_money4" name="value_for_money" value="4">
                                                        <label for="value_for_money4"></label>
                                                        <input type="radio" id="value_for_money3" name="value_for_money" value="3">
                                                        <label for="value_for_money3"></label>
                                                        <input type="radio" id="value_for_money2" name="value_for_money" value="2">
                                                        <label for="value_for_money2"></label>
                                                        <input type="radio" id="value_for_money1" name="value_for_money" value="1">
                                                        <label for="value_for_money1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <h5>Agent support</h5>
                                                    <div class="rate-stars">
                                                        <input type="radio" id="agent_support5" name="agent_support" value="5" checked>
                                                        <label for="agent_support5"></label>
                                                        <input type="radio" id="agent_support4" name="agent_support" value="4">
                                                        <label for="agent_support4"></label>
                                                        <input type="radio" id="agent_support3" name="agent_support" value="3">
                                                        <label for="agent_support3"></label>
                                                        <input type="radio" id="agent_support2" name="agent_support" value="2">
                                                        <label for="agent_support2"></label>
                                                        <input type="radio" id="agent_support1" name="agent_support" value="1">
                                                        <label for="agent_support1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <div class="average-rating">
                                                <h4 class="avg-rate">4.25</h4>
                                                <span>Average Rating</span>
                                            </div>
                                        </div>
                                        <style>
                                            .rate-stars {
                                                display: flex;
                                                flex-direction: row-reverse;
                                                justify-content: flex-end;
                                            }

                                            .rate-stars input {
                                                display: none;
                                            }
                                            .rate-stars label {
                                                width: 25px;
                                                height: 25px;
                                                background: #ddd;
                                                clip-path: polygon(
                                                    50% 0%,
                                                    61% 35%,
                                                    98% 35%,
                                                    68% 57%,
                                                    79% 91%,
                                                    50% 70%,
                                                    21% 91%,
                                                    32% 57%,
                                                    2% 35%,
                                                    39% 35%
                                                );
                                                cursor: pointer;
                                                transition: 0.3s;
                                                margin: 0 2px;
                                            }

                                            .rate-stars input:checked ~ label,
                                            .rate-stars label:hover,
                                            .rate-stars label:hover ~ label {
                                                background: #f7b731;
                                            }

                                            .average-rating {
                                                text-align: center;
                                                padding: 20px;
                                                background: #e9ecef;
                                                border-radius: 8px;
                                                margin: 20px 0;
                                                color: #353535;
                                            }
                                        </style>

                                        <script>
                                            // Function to update average rating as user selects ratings
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const ratingInputs = document.querySelectorAll('.rate-stars input');
                                                const avgRatingElement = document.querySelector('.avg-rate');

                                                ratingInputs.forEach(input => {
                                                    input.addEventListener('change', updateAverageRating);
                                                });

                                                function updateAverageRating() {
                                                    const categories = ['property', 'location', 'value_for_money', 'agent_support'];
                                                    let total = 0;
                                                    let count = 0;

                                                    categories.forEach(category => {
                                                        const selectedRating = document.querySelector(`input[name="${category}"]:checked`);
                                                        if (selectedRating) {
                                                            total += parseInt(selectedRating.value);
                                                            count++;
                                                        }
                                                    });

                                                    if (count > 0) {
                                                        const average = total / count;
                                                        avgRatingElement.textContent = average.toFixed(2);
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>

                                    <!-- Review Ratings Message -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control ht-80" placeholder="Messages"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Your Name">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Your Email">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <button class="btn btn-main fw-medium px-lg-5 rounded" type="submit">Submit Review</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div> --}}

                </div>

                <!-- property Sidebar -->
                <div class="col-lg-4 col-md-12 col-sm-12 d-none">

                    <!-- Like And Share -->
                    <div class="like_share_wrap b-0">
                        <ul class="like_share_list">
                            <li><a href="JavaScript:Void(0);" class="btn btn-gray" data-toggle="tooltip" data-original-title="Share"><i class="fas fa-share"></i>Share</a></li>
                            <li><a href="JavaScript:Void(0);" class="btn btn-gray" data-toggle="tooltip" data-original-title="Save"><i class="fas fa-heart"></i>Save</a></li>
                        </ul>
                    </div>

                    <div class="property-sidebar side_stiky">

                        <div class="sider_blocks_wrap">
                            <div class="side-booking-header">
                                <ul class="nav nav-pills sider_tab" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                    <a class="nav-link active" id="pills-book-tab" data-bs-toggle="pill" href="#pills-book" role="tab" aria-controls="pills-home" aria-selected="true">Book Now</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" id="pills-appointment-tab" data-bs-toggle="pill" href="#pills-appointment" role="tab" aria-controls="pills-appointment" aria-selected="false">Appointment</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sidetab-content">
                                <div class="tab-content" id="pills-tabContent">
                                    <!-- Book Now Tab -->
                                    <div class="tab-pane fade show active" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                                        <div class="side-booking-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="form-group">
                                                        <label for="guests">Check In</label>
                                                        <div class="cld-box">
                                                            <i class="fa-solid fa-calendar-week"></i>
                                                            <input type="text" name="checkin" class="form-control" value="10/24/2020" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="form-group">
                                                        <label for="guests">Check Out</label>
                                                        <div class="cld-box">
                                                            <i class="fa-solid fa-calendar-week"></i>
                                                            <input type="text" name="checkout" class="form-control" value="10/24/2020" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="form-group">
                                                        <div class="guests">
                                                            <label for="guests">Adults</label>
                                                            <div class="guests-box">
                                                                <button class="counter-btn" type="button" id="cnt-down"><i class="fa-solid fa-minus"></i></button>
                                                                <input type="text" id="guestNo" name="guests" value="2"/>
                                                                <button class="counter-btn" type="button" id="cnt-up"><i class="fa-solid fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                    <div class="form-group">
                                                        <div class="guests">
                                                            <label for="guests">Kids</label>
                                                            <div class="guests-box">
                                                                <button class="counter-btn" type="button" id="kcnt-down"><i class="fa-solid fa-minus"></i></button>
                                                                <input type="text" id="kidsNo" name="kids" value="0"/>
                                                                <button class="counter-btn" type="button" id="kcnt-up"><i class="fa-solid fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                    <label class="fw-medium fs-6">Advance features</label>
                                                    <div class="_adv_features_list">
                                                        <ul class="no-ul-list">
                                                            <li>
                                                                <input id="a-1" class="form-check-input" name="a-1" type="checkbox">
                                                                <label for="a-1" class="form-check-label">Air Condition<i class="ms-3">$10</i></label>
                                                            </li>
                                                            <li>
                                                                <input id="a-2" class="form-check-input" name="a-2" type="checkbox" checked>
                                                                <label for="a-2" class="form-check-label">Bedding<i class="ms-3">$07</i></label>
                                                            </li>
                                                            <li>
                                                                <input id="a-3" class="form-check-input" name="a-3" type="checkbox" checked>
                                                                <label for="a-3" class="form-check-label">Heating<i class="ms-3">$20</i></label>
                                                            </li>
                                                            <li>
                                                                <input id="a-4" class="form-check-input" name="a-4" type="checkbox">
                                                                <label for="a-4" class="form-check-label">Internet<i class="ms-3">$10</i></label>
                                                            </li>
                                                            <li>
                                                                <input id="a-5" class="form-check-input" name="a-5" type="checkbox">
                                                                <label for="a-5" class="form-check-label">Microwave<i class="ms-3">$05</i></label>
                                                            </li>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                                    <label for="guests">Price & Tax</label>
                                                    <div class="_adv_features">
                                                        <ul>
                                                            <li>I Night<span>$310</span></li>
                                                            <li>Discount 25$<span>-$250</span></li>
                                                            <li>Service Fee<span>$17</span></li>
                                                            <li>Breakfast Per Adult<span>$35</span></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="side-booking-foot">
                                                        <span class="sb-header-left">Total Payment</span>
                                                        <h3 class="price text-main">$170</h3>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="stbooking-footer mt-1">
                                                        <div class="form-group mb-0 pb-0">
                                                            <a href="#" class="btn btn-main fw-medium full-width">Book It Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Appointment Now Tab -->
                                    <div class="tab-pane fade" id="pills-appointment" role="tabpanel" aria-labelledby="pills-appointment-tab">
                                        <div class="sider-block-body p-3">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input type="text" class="form-control light" placeholder="Enter Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Email ID</label>
                                                        <input type="text" class="form-control light" placeholder="Enter eMail ID">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="text" class="form-control light" placeholder="Enter Phone No.">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea class="form-control light" placeholder="Explain Query"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <button class="btn btn-main fw-medium full-width">Make Appointment</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Property Detail End ================================== -->

@endsection
</x-frontend-layout>
