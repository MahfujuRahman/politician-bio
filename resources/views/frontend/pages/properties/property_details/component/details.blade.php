<!-- SHOP DETAILS AREA START -->
<div class="ltn__shop-details-area pb-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__shop-details-inner ltn__page-details-inner mb-60">
                    <div class="ltn__blog-meta">
                        <ul>
                            <li class="ltn__blog-category">
                                <a href="#">{{ $property?->category?->name }}</a>
                            </li>
                            <li class="ltn__blog-category">
                                <a class="bg-orange" href="#">For {{ $property?->property_status }}</a>
                            </li>
                            <li class="ltn__blog-date">
                                {{-- <i class="far fa-calendar-alt"></i>{{ $property?->date }} --}}
                                {{-- <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($property?->date)->format('F j, Y') }} --}}
                                @if ($property?->date)
                                    <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($property->date)->format('F j, Y') }}
                                @endif
                            </li>
                            <li>
                                <a href="#"><i class="far fa-comments"></i>{{count($property_customer_reviews)}} Comments</a>
                            </li>
                        </ul>
                    </div>
                    <h1>{{ $property?->property_name }}</h1>
                    <label><span class="ltn__secondary-color"><i class="flaticon-pin"></i></span> {{ $property?->property_address }}</label>
                    <h4 class="title-2">Description</h4>
                    {{-- <p>{{ \Illuminate\Support\Str::of(strip_tags($property?->property_description ?? ''))->trim() }}</p> --}}
                    <p>{!! $property?->property_description !!}</p>
                    {{-- <p>To the left is the modern kitchen with central island, leading through to the unique breakfast family room which feature glass walls and doors out onto the garden and access to the separate utility room.</p> --}}

                    <h4 class="title-2">Property Detail</h4>  
                    <div class="property-detail-info-list section-bg-1 clearfix mb-60 p-3">   
                        <p>
                            {!! $property?->property_detail !!}
                        </p>
                        {{-- <ul>
                            <li><label>Property ID:</label> <span>HZ29</span></li>
                            <li><label>Home Area: </label> <span>120 sqft</span></li>
                            <li><label>Rooms:</label> <span>7</span></li>
                            <li><label>Baths:</label> <span>2</span></li>
                            <li><label>Year built:</label> <span>1992</span></li>
                        </ul>
                        <ul>
                            <li><label>Lot Area:</label> <span>HZ29 </span></li>
                            <li><label>Lot dimensions:</label> <span>120 sqft</span></li>
                            <li><label>Beds:</label> <span>7</span></li>
                            <li><label>Price:</label> <span>2</span></li>
                            <li><label>Property Status:</label> <span>For Sale</span></li>
                        </ul> --}}
                    </div>
                                    
                    <h4 class="title-2">Facts and Features</h4>
                    <div class="property-detail-feature-list clearfix mb-45">                            
                        <ul>
                            @foreach ($property?->facts_and_features as $item)
                                <li>
                                    <div class="property-detail-feature-list-item">
                                        <i class="{{ $item['icon'] ?? '' }}"></i>
                                        <div>
                                            <h6>{{ $item['title'] ?? '' }}</h6>
                                            <small>{{ $item['description'] ?? '' }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            {{-- <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Garage</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Dining Area</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Bedroom</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Bathroom</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Gym Area</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Garden</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="property-detail-feature-list-item">
                                    <i class="flaticon-double-bed"></i>
                                    <div>
                                        <h6>Parking</h6>
                                        <small>20 x 16 sq feet</small>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                    </div>

                    <h4 class="title-2">From Our Gallery</h4>
                    <div class="ltn__property-details-gallery mb-30">
                        <div class="row">
                            @php
                                $gallery = $property->gallery ?? [];
                            @endphp

                            <div class="col-md-6 mb-30">
                                <div class="row">
                                    <div class="col-12 mb-30">
                                        <a href="{{ asset($gallery[0] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                            <img class="property_gallery_custom" src="{{ asset($gallery[0] ?? 'uploads/default.jpg') }}" alt="Image">
                                        </a>
                                    </div>
                                    <div class="col-12">
                                        <a href="{{ asset($gallery[1] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                            <img class="property_gallery_custom" src="{{ asset($gallery[1] ?? 'uploads/default.jpg') }}" alt="Image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-30">
                                <a href="{{ asset($gallery[2] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                    <img class="property_gallery_custom_right" src="{{ asset($gallery[2] ?? 'uploads/default.jpg') }}" alt="Image">
                                </a>
                            </div>

                            {{-- <div class="col-lg-12 p-0">
                                <div class="image_gallery_wrap h-100">
                                    <div class="row h-100 g-4">
                                        <div class="col-md-6 d-flex flex-column gap-4">
                                            <div class="flex-fill">
                                                
                                                <a href="{{ asset($property->gallery[0] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                                    <img class="image_default_custom w-100 h-100" src="{{ asset($property->gallery[0] ?? 'uploads/default.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                            <div class="flex-fill">
                                                
                                                <a href="{{ asset($property->gallery[1] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                                    <img class="image_default_custom w-100 h-100" src="{{ asset($property->gallery[1] ?? 'uploads/default.jpg') }}" alt="Image">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <a href="{{ asset($property->gallery[2] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                                <img class="image_default_custom w-100 h-100" src="{{ asset($property->gallery[2] ?? 'uploads/default.jpg' ) }}" alt="Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <h4 class="title-2 mb-10">Amenities</h4>
                    <div class="property-details-amenities mb-60">
                        @php
                            $amenities = $property->amenities ?? [];
                            $chunks = array_chunk($amenities, ceil(count($amenities) / 3));
                        @endphp
                        <div class="row">
                            @foreach($chunks as $chunk)
                                <div class="col-lg-4 col-md-6">
                                    <div class="ltn__menu-widget">
                                        <ul>
                                            @foreach($chunk as $item)
                                                <li>
                                                    <label class="checkbox-item">{{ $item['title'] ?? ''}}
                                                        <input type="checkbox" {{ isset($item['available']) && $item['available'] === 'true' ? 'checked' : '' }}>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @php
                        function getGoogleMapEmbedUrl($url) {
                            if (!$url) {
                                return null;
                            }
                            if (Str::contains($url, '/maps/embed?')) {
                                return $url;
                            }
                            if (Str::contains($url, '/maps/place/') || Str::contains($url, '/maps/search/')) {
                                return str_replace('/maps/', '/maps/embed/', $url);
                            }
                            return null; // Not a valid Google Maps location URL
                        }
                        $mapUrl = getGoogleMapEmbedUrl($property?->map_location_url ?? '');
                    @endphp

                    <h4 class="title-2">Location</h4>
                    <div class="property-details-google-map mb-60">
                        @if($mapUrl)
                            <iframe src="{{ $mapUrl }}" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        @else
                            <div class="alert alert-warning">
                                Location map is not available for this property.
                            </div>
                            {{-- Or show a placeholder image --}}
                            {{-- <img src="{{ asset('uploads/default.jpg') }}" alt="No location available" style="width:100%;max-width:400px;"> --}}
                        @endif
                    </div>

                    <h4 class="title-2">Floor Plans</h4>
                    <!-- APARTMENTS PLAN AREA START -->
                    <div class="ltn__apartments-plan-area product-details-apartments-plan mb-60">
                        <div class="ltn__tab-menu ltn__tab-menu-3 ltn__tab-menu-top-right-- text-uppercase--- text-center---">
                            <div class="nav">
                                @foreach ( $property?->floor_plan as $key => $floor )
                                    @if ($key == 0)
                                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_3_{{ $key }}">{{ $floor['floor_number'] }}</a>
                                    @else
                                        <a data-bs-toggle="tab" href="#liton_tab_3_{{ $key }}">{{ $floor['floor_number'] }}</a>
                                    @endif
                                    
                                @endforeach
                                {{-- <a data-bs-toggle="tab" href="#liton_tab_3_0">First Floor</a>
                                <a class="active show"  data-bs-toggle="tab" href="#liton_tab_3_2" class="">Second Floor</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_3" class="">Third Floor</a>
                                <a data-bs-toggle="tab" href="#liton_tab_3_4" class="">Top Garden</a> --}}
                            </div>
                        </div>
                        <div class="tab-content">
                            @foreach ( $property?->floor_plan as $key => $floor )
                                <div class="tab-pane fade {{ $key === 0 ? 'active show' : '' }}" id="liton_tab_3_{{ $key }}">
                                    <div class="ltn__apartments-tab-content-inner">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="apartments-plan-img">
                                                    <a href="{{ asset($floor['image'] ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                                        <img src="{{ asset( $floor['image'] ?? 'uploads/default.jpg') }}" alt="#">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="apartments-plan-info ltn__secondary-bg--- text-color-white---">
                                                    <h2>{{ $floor['floor_number'] ?? 'Default' }}</h2>
                                                    <p>{{ $floor['description'] ?? 'no description'}}</p>
                                                </div>
                                            </div>
                                            {{-- <div class="col-lg-12">
                                                <div class="product-details-apartments-info-list  section-bg-1">
                                                    @php
                                                        $floor_details = collect($property?->floor_plan_details ?? [])->values();

                                                        $chunks = [];

                                                        if ($floor_details->count() > 0) {
                                                            $chunks = $floor_details->chunk(ceil($floor_details->count() / 2));
                                                        }
                                                    @endphp
                                                    <div class="row">
                                                        @foreach($chunks as $chunk)
                                                                <div class="col-lg-6">
                                                                    <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                                        <ul>
                                                                            @foreach($chunk as $floor_detail)
                                                                                <li>
                                                                                    <label>{{ $floor_detail['title'] ?? 'N/A' }}</label>
                                                                                    <span>{{ $floor_detail['description'] ?? 'N/A' }}</span>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="product-details">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="product-details-apartments-info-list  section-bg-1">
                                            @php
                                                $floor_details = collect($property?->floor_plan_details ?? [])->values();

                                                $chunks = [];

                                                if ($floor_details->count() > 0) {
                                                    $chunks = $floor_details->chunk(ceil($floor_details->count() / 2));
                                                }
                                            @endphp
                                            <div class="row">
                                                @foreach($chunks as $chunk)
                                                        <div class="col-lg-6">
                                                            <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                                <ul>
                                                                    @foreach($chunk as $floor_detail)
                                                                        <li>
                                                                            <label>{{ $floor_detail['title'] ?? 'N/A' }}</label>
                                                                            <span>{{ $floor_detail['description'] ?? 'N/A' }}</span>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="tab-pane fade active show" id="liton_tab_3_2">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="apartments-plan-img">
                                                <img src="{{ asset('assets/frontend') }}/img/others/10.png" alt="#">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="apartments-plan-info ltn__secondary-bg--- text-color-white---">
                                                <h2>Second Floor</h2>
                                                <p>Enimad minim veniam quis nostrud exercitation ullamco laboris.
                                                    Lorem ipsum dolor sit amet cons aetetur adipisicing elit sedo
                                                    eiusmod tempor.Incididunt labore et dolore magna aliqua.
                                                    sed ayd minim veniam.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-details-apartments-info-list  section-bg-1">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Total Area</label> <span>2800 Sq. Ft</span></li>
                                                                <li><label>Bedroom</label> <span>150 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Belcony/Pets</label> <span>Allowed</span></li>
                                                                <li><label>Lounge</label> <span>650 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_3">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="apartments-plan-img">
                                                <img src="{{ asset('assets/frontend') }}/img/others/10.png" alt="#">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="apartments-plan-info ltn__secondary-bg--- text-color-white---">
                                                <h2>Third Floor</h2>
                                                <p>Enimad minim veniam quis nostrud exercitation ullamco laboris.
                                                    Lorem ipsum dolor sit amet cons aetetur adipisicing elit sedo
                                                    eiusmod tempor.Incididunt labore et dolore magna aliqua.
                                                    sed ayd minim veniam.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-details-apartments-info-list  section-bg-1">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Total Area</label> <span>2800 Sq. Ft</span></li>
                                                                <li><label>Bedroom</label> <span>150 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Belcony/Pets</label> <span>Allowed</span></li>
                                                                <li><label>Lounge</label> <span>650 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_3_4">
                                <div class="ltn__product-tab-content-inner">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="apartments-plan-img">
                                                <img src="{{ asset('assets/frontend') }}/img/others/10.png" alt="#">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="apartments-plan-info ltn__secondary-bg--- text-color-white---">
                                                <h2>Top Garden</h2>
                                                <p>Enimad minim veniam quis nostrud exercitation ullamco laboris.
                                                    Lorem ipsum dolor sit amet cons aetetur adipisicing elit sedo
                                                    eiusmod tempor.Incididunt labore et dolore magna aliqua.
                                                    sed ayd minim veniam.</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="product-details-apartments-info-list  section-bg-1">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Total Area</label> <span>2800 Sq. Ft</span></li>
                                                                <li><label>Bedroom</label> <span>150 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="apartments-info-list apartments-info-list-color mt-40---">
                                                            <ul>
                                                                <li><label>Belcony/Pets</label> <span>Allowed</span></li>
                                                                <li><label>Lounge</label> <span>650 Sq. Ft</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <!-- APARTMENTS PLAN AREA END -->
                    @php
                        function getYoutubeEmbedUrl($url) {
                            $default = 'https://www.youtube.com/embed/x9gIy59kWw0?autoplay=1&showinfo=0';
                            if (!$url) {
                                return $default;
                            }
                            // If already an embed link, return as is
                            if (Str::contains($url, 'youtube.com/embed/')) {
                                return $url;
                            }
                            // Handle normal YouTube links
                            if (preg_match('/(?:youtube\\.com\\/watch\\?v=|youtu\\.be\\/)([\\w-]+)/', $url, $matches)) {
                                return 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&showinfo=0';
                            }
                            // Fallback
                            return $default;
                        }
                        $videoUrl = getYoutubeEmbedUrl($property?->property_video_url ?? '');
                    @endphp

                    <h4 class="title-2">Property Video</h4>
                    <div class="ltn__video-bg-img ltn__video-popup-height-500 bg-overlay-black-50 bg-image mb-60" data-bs-bg="{{ asset($property->gallery[0] ?? 'uploads/default.jpg') }}">
                        <a class="ltn__video-icon-2 ltn__video-icon-2-border---" href="{{ $videoUrl }}" data-rel="lightcase:myCollection">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                    
                    <div class="ltn__shop-details-tab-content-inner--- ltn__shop-details-tab-inner-2 ltn__product-details-review-inner mb-60">
                        <h4 class="title-2">Customer Reviews</h4>
                        @php
                            $totalReviews = count($property_customer_reviews);
                            $totalRating = array_sum(array_column($property_customer_reviews->toArray(), 'rating'));
                            $averageRating = $totalReviews > 0 ? $totalRating / $totalReviews : 0;
                        @endphp
                        <div class="product-ratting">
                            <ul>
                                @for ($i = 0; $i < 5; $i++)
                                    <li>
                                        <a href="#">
                                            @if ($i < floor($averageRating))
                                                <i class="fas fa-star"></i>
                                            @elseif ($i < ceil($averageRating))
                                                <i class="fas fa-star-half-alt"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        </a>
                                    </li>
                                @endfor
                                <li class="review-total"> <a href="#"> ( {{ $totalReviews }} Reviews )</a></li>
                            </ul>
                        </div>
                        <hr>
                        <!-- comment-area -->
                        <div class="ltn__comment-area mb-30">
                            <div class="ltn__comment-inner">
                                <ul>
                                    @foreach ($property_customer_reviews as $review)
                                        <li>
                                            <div class="ltn__comment-item clearfix">
                                                <div class="ltn__commenter-img">
                                                    <img src="{{ asset($review['image'] ?? 'uploads/default_man.jpeg') }}" alt="Image">
                                                </div>
                                                <div class="ltn__commenter-comment">
                                                    <h6><a href="#">{{ $review['name'] ?? '' }}</a></h6>
                                                    <div class="product-ratting">
                                                        <ul>
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <li>
                                                                    <a href="#">
                                                                        <i class="{{ $i < ($review['rating'] ?? 0) ? 'fas fa-star' : 'far fa-star' }}"></i>
                                                                    </a>
                                                                </li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p>{{ $review['comment'] ?? '' }}</p>
                                                    <span class="ltn__comment-reply-btn">{{ isset($review['created_at']) ? \Carbon\Carbon::parse($review['created_at'])->format('F j, Y') : '' }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    {{-- <li>
                                        <div class="ltn__comment-item clearfix">
                                            <div class="ltn__commenter-img">
                                                <img src="{{ asset('assets/frontend') }}/img/testimonial/Kawser-Ali.png" alt="Image">
                                            </div>
                                            <div class="ltn__commenter-comment">
                                                <h6><a href="#">Kawser Ali</a></h6>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ltn__comment-item clearfix">
                                            <div class="ltn__commenter-img">
                                                <img src="{{ asset('assets/frontend') }}/img/testimonial/Mr.-Helal.png" alt="Image">
                                            </div>
                                            <div class="ltn__commenter-comment">
                                                <h6><a href="#">Mr.Helal</a></h6>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                            </div>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                        <!-- comment-reply -->
                        <div id="reviewFormWrapper"  class="ltn__comment-reply-area ltn__form-box mb-30">
                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}
                            <form id="review_form" action="{{ route('property_customer_review') }}" method="POST">
                                @csrf
                                <input type="hidden" name="property_id" value="{{ $property->id }}">
                                
                                <h4>Add a Review</h4>
                                <div class="mb-30">
                                    <div class="add-a-review">
                                        <h6>Your Ratings:</h6>
                                        <div class="product-ratting">
                                            <ul>
                                                <li class="customer_rating"><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li class="customer_rating"><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li class="customer_rating"><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li class="customer_rating"><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li class="customer_rating"><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                            <input type="hidden" name="rating" id="rating" value="5">
                                        </div>
                                        @error('rating')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="comment" placeholder="Type your comments...."></textarea>
                                    @error('comment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-item input-item-name ltn__custom-icon mb-3" >
                                    <input class="mb-0" type="text" name="name" placeholder="Type your name....">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-item input-item-email ltn__custom-icon mb-3">
                                    <input class="mb-0" type="email" name="email" placeholder="Type your email....">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-item input-item-website ltn__custom-icon mb-3">
                                    <input class="mb-0" type="text" name="website" placeholder="Type your website....">
                                    @error('website')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <label class="mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label> --}}
                                <div class="btn-wrapper">
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase border" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @include('frontend.pages.properties.property_details.component.related_property')
                </div>
            </div>
            
        </div>
    </div>
</div>
@push('js_start')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Property details page loaded');
            // Example: Add event listeners or custom functionality here
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.product-ratting .customer_rating');
            const ratingInput = document.getElementById('rating');
            
            stars.forEach((star, index) => {
                star.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Set the hidden input value
                    ratingInput.value = index + 1;
    
                    // Optional: highlight stars up to the clicked one
                    stars.forEach((s, i) => {
                        s.querySelector('i').classList.toggle('text-warning', i <= index);
                    });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                setTimeout(function () {
                    const wrapper = document.getElementById('reviewFormWrapper');
                    if (wrapper) {
                        wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100); // Delay lets browser finish default scroll first
            @endif
        });
    </script>
@endpush
<!-- SHOP DETAILS AREA END -->