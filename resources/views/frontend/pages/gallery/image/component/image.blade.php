<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pt-50 pb-50 plr--7">
    <div class="container" id="all_images">
        <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h1 class="section-title ltn__secondary-color">Images View</h1>
                </div>
            </div>
        </div>
        @include('frontend.pages.gallery.image.component.filterizr')
        <div class="row">

            @foreach ($images as $image)
            <div class="col-lg-4 image_container" data-category="{{ $image?->category?->name ?? 'all' }}">
                    <div class="ltn__product-item ltn__product-item-4 text-center---">
                        <div class="product-img">
                            <a href="{{ asset($image?->image ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                                <img class="gallery_img_custom" src="{{ asset($image?->image ?? 'uploads/default.jpg') }}" alt="image gallery">
                            </a>
                        </div>
                        <div class="product-info">
                            <h2 class="product-title"><a href="javascript:void(0)">{{$image?->title}}</a></h2>
                        </div>
                    </div>
                </div>
                
            @endforeach

            {{-- <!-- ltn__product-item -->
            <div class="col-lg-4 image_container" data-category="residential">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/1.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container" data-category="residential">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/5.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container" data-category="residential">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/2.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/3.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/4.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/5.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/1.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div>
             <!-- ltn__product-item -->
             <div class="col-lg-4 image_container">
                <div class="ltn__product-item ltn__product-item-4 text-center---">
                    <div class="product-img">
                        <img src="{{ asset('assets/frontend') }}/img/product-3/1.jpg" alt="#">
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                    </div>
                </div>
            </div> --}}

            
            <!--  -->
        </div>
    </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->