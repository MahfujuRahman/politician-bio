<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pt-50 pb-50 plr--7">
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h1 class="section-title ltn__secondary-color">Video Gallery</h1>
                    </div>
                </div>
            </div>
            @include('frontend.pages.gallery.video.component.filterizr')
            <div class="row">
                @foreach ($videos as $video)

                @php
                    $defaultVideoId = '4jnzf1yj48M'; // Your fallback YouTube video ID
                    $videoId = null;

                    if (!empty($video?->video)) {
                        // Try to extract the video ID from a YouTube link
                        preg_match(
                            '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([^\s&]+)/',
                            $video->video,
                            $matches
                        );
                        $videoId = $matches[1] ?? null;
                    }

                    // Use default video if ID is not extracted
                    $embedId = $videoId ?: $defaultVideoId;
                    $embedUrl = "https://www.youtube.com/embed/{$embedId}";
                @endphp
                <!-- ltn__product-item -->
                    <div class="col-lg-4 image_container" data-category="{{ $video?->category?->name ?? 'all' }}">
                        <div class="ltn__product-item ltn__product-item-4 text-center---">
                            <div class="product-img">
                                <iframe width="560" height="315" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                    </div>
                            <div class="product-info">
                                <h2 class="product-title"><a href="javascript:void(0)">{{ $video?->title }}</a></h2>
                            </div>
                        </div>
                    </div>
                @endforeach
                 {{-- <!-- ltn__product-item -->
                 <div class="col-lg-4">
                    <div class="ltn__product-item ltn__product-item-4 text-center---">
                        <div class="product-img">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/RJSd8nPAQ_o?si=3Fcc3k65NM98ubAd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>                    </div>
                        <div class="product-info">
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                        </div>
                    </div>
                </div>
                 <!-- ltn__product-item -->
                 <div class="col-lg-4">
                    <div class="ltn__product-item ltn__product-item-4 text-center---">
                        <div class="product-img">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/InsAkFDoeL8?si=voIOaS8VL85wrFIp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                        <div class="product-info">
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                        </div>
                    </div>
                </div> --}}
             
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->