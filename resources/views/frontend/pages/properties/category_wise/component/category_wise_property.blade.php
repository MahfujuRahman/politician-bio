<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pt-50 pb-50 plr--7">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Properties Listings</h6>
                    <h1 class="section-title">{{$category_name}} Properties</h1>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ( $properties as $property )
                <div class="col-lg-4 col-md-6">
                    <div class="ltn__product-item ltn__product-item-4 text-center---">
                        <div class="product-img ">
                            <a href="{{ route('properties_details', $property->id) }}"><img class="property_img_custom" src="{{  is_countable($property?->banner_image) && count($property?->banner_image) ? asset($property->banner_image[0]) : asset('default-image.jpg') }}" alt="#"></a>
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badge {{ $property?->property_status === 'sale' ? 'bg-green' : 'bg-primary' }}">
                                        {{ $property?->property_status }}
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-location-gallery">
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            {{-- <a href="javascript:void(0)"><i class="flaticon-pin"></i> {{ $property?->property_address }}</a> --}}
                                            @php
                                                $mapUrl = $property?->map_location_url;
                                                // Convert embed link to standard Google Maps link if needed
                                                if (Str::startsWith($mapUrl, 'https://www.google.com/maps/embed?pb=')) {
                                                    $mapUrl = str_replace('/embed?', '?', $mapUrl);
                                                }
                                                $isGoogleMap = Str::startsWith($mapUrl, [
                                                    'https://www.google.com/maps',
                                                    'https://maps.google.com'
                                                ]);
                                            @endphp

                                            @if($isGoogleMap)
                                                <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer">
                                                    <i class="flaticon-pin"></i> {{ $property?->property_address }}
                                                </a>
                                            @else
                                                <span><i class="flaticon-pin"></i> {{ $property?->property_address }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="product-img-gallery">
                                    <ul>
                                        <li>
                                            <a href="{{ route('properties_details', $property->id) }}"><i class="fas fa-camera"></i> {{ count($property?->banner_image ?? []) }}</a>
                                        </li>
                                        {{-- <li>
                                            <a href="{{ route('properties_details', $property->id) }}"><i class="fas fa-film"></i> {{ count($property?->banner_image ?? []) }}</a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-price">
                                <span>৳ {{ $property?->price ?? 00 }}
                                    @if($property?->property_status !== 'sale')
                                        <label>/month</label>
                                    @endif
                                </span>
                            </div>
                            <h2 class="product-title"><a href="{{ route('properties_details', $property->id) }}"> {{ $property?->property_name }}</a></h2>
                            <div class="product-description">
                                <p>{{ Str::limit(strip_tags($property?->property_description), 90) }}</p>
                            </div>
                            <ul class="ltn__list-item-2 ltn__list-item-2-before">
                                @foreach ( array_slice($property?->facts_and_features, 0, 2) as $feature )
                                    <li><span>{{ $feature['title'] ?? "" }} <i class="{{ $feature['icon'] ?? "" }}"></i></span>
                                        {{ $feature['description'] ?? "" }}
                                    </li>
                                @endforeach
                                {{-- <li><span>3 <i class="flaticon-bed"></i></span>
                                    Bedrooms
                                </li>
                                <li><span>2 <i class="flaticon-clean"></i></span>
                                    Bathrooms
                                </li>
                                <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                    square Ft
                                </li> --}}
                            </ul>
                        </div>
                        {{-- <div class="product-info-bottom">
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                                </div>
                                <div class="agent-brief">
                                    <h6><a href="team-details.html">Starlite</a></h6>
                                    <small>Starlite Agents</small>
                                </div>
                            </div>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="flaticon-expand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="flaticon-heart-1"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('properties_details', $property->id) }}" title="Product Details">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
                
            @endforeach
            <!-- ltn__product-item -->
            {{-- <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/1.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__product-item -->
            <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/2.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green---">For Sale</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Modern Apartments</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__product-item -->
            <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge bg-green">For Rent</li>
                            </ul>
                        </div>
                        <div class="product-img-location-gallery">
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="locations.html"><i class="flaticon-pin"></i> Bashundhara, Dhaka</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product-img-gallery">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-camera"></i> 4</a>
                                    </li>
                                    <li>
                                        <a href="product-details.html"><i class="fas fa-film"></i> 2</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-price">
                            <span>$34,900<label>/Month</label></span>
                        </div>
                        <h2 class="product-title"><a href="product-details.html">Comfortable Apartment</a></h2>
                        <div class="product-description">
                            <p>Beautiful Huge 1 Family House In Heart Of <br>
                                Westbury. Newly Renovated With New Wood</p>
                        </div>
                        <ul class="ltn__list-item-2 ltn__list-item-2-before">
                            <li><span>3 <i class="flaticon-bed"></i></span>
                                Bedrooms
                            </li>
                            <li><span>2 <i class="flaticon-clean"></i></span>
                                Bathrooms
                            </li>
                            <li><span>3450 <i class="flaticon-square-shape-design-interface-tool-symbol"></i></span>
                                square Ft
                            </li>
                        </ul>
                    </div>
                    <div class="product-info-bottom">
                        <div class="real-estate-agent">
                            <div class="agent-img">
                                <a href="team-details.html"><img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                            </div>
                            <div class="agent-brief">
                                <h6><a href="team-details.html">Starlite</a></h6>
                                <small>Starlite Agents</small>
                            </div>
                        </div>
                        <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="flaticon-expand"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="flaticon-heart-1"></i></a>
                                </li>
                                <li>
                                    <a href="product-details.html" title="Product Details">
                                        <i class="flaticon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--  -->
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->