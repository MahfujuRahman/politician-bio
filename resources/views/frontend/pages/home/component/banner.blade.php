<!-- SLIDER AREA START (slider-4) -->
<section>
    <div class="">
        <div class="ltn__slider-area ltn__slider-4 position-relative ltn__primary-bg fix">
            <div 
                class="ltn__slide-one-active----- slick-slide-arrow-1----- slick-slide-dots-1----- arrow-white----- ltn__slide-animation-active">
        
                <!-- HTML5 VIDEO -->
                {{-- <video autoplay muted loop id="myVideo">
                    <source src="{{ asset('assets/frontend/media/3.mp4') }}" type="video/mp4">
                    <source src="{{ asset('assets/frontend' . ($banner?->video_file ?? '/media/3.mp4')) }}" type="{{$banner?->video_type ?? 'video/mp4'}}">
                    <source src="{{ $banner?->video_file ?? '/media/3.mp4' }}" type="video/mp4">

                </video> --}}
        
                <!-- YouTube VIDEO -->
                <!-- <div class="ltn__youtube-video-background">
                        <iframe frameborder="0" height="100%" width="100%"
                          src="https://www.youtube.com/embed/9ge5PzHSS0Y?playlist=9ge5PzHSS0Y&loop=1&controls=0&showinfo=0&autoplay=1&mute=1">
                        </iframe>
                    </div> -->
                    
                @if (!empty($banner?->video_file))
                    <!-- HTML5 VIDEO -->
                    <video autoplay muted loop id="myVideo">
                        {{-- <source src="{{ asset($banner->video_file) }}" type="{{ $banner->video_type ?? 'video/mp4' }}"> --}}
                        <source src="{{ asset($banner->video_file) }}" type="{{'video/mp4' }}">
                        Your browser does not support HTML5 video.
                    </video>
                @elseif (!empty($banner?->video_url))
                    <!-- YouTube VIDEO -->
                    @php
                        // Extract video ID from the YouTube URL
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $banner->video_url, $matches);
                        $youtubeId = $matches[1] ?? '4jnzf1yj48M';
                    @endphp
                
                    @if ($youtubeId)
                        <div class="ltn__youtube-video-background">
                            <iframe
                                frameborder="0"
                                height="100%"
                                width="100%"
                                src="https://www.youtube.com/embed/{{ $youtubeId }}?playlist={{ $youtubeId }}&loop=1&controls=0&showinfo=0&autoplay=1&mute=1"
                                allow="autoplay"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @endif
                @endif
                <!-- ltn__slide-item -->
                <div class="ltn__slide-item ltn__slide-item-2 ltn__slide-item-7 bg-image--- bg-overlay-theme-black-10---"
                    data-bs-bg="img/slider/41.jpg">
                    <div class="ltn__slide-item-inner text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 align-self-center">
                                    <div class="slide-item-info">
                                        <div class="slide-item-info-inner ltn__slide-animation">
                                            <h6 class="slide-sub-title white-color animated"><span><i
                                                        class="fas fa-home"></i></span> {{ $banner?->short_title }}</h6>
                                            <h1 class="slide-title text-uppercase white-color animated ">{{ $banner?->short_description }}</h1>
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
<!-- SLIDER AREA END -->
