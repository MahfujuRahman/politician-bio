 <!-- ABOUT US AREA START -->
 <div class="ltn__about-us-area pt-50 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="about-us-img-wrap about-img-left">
                    {{-- <img src="{{ asset('assets/frontend') }}/img/others/7.png" alt="About Us Image"> --}}
                    <a href="{{ asset($about_us?->primary_image	?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                        <img class="about_us_custom" src="{{ asset($about_us?->primary_image ?? 'uploads/default.jpg') }}" alt="About Us Image">

                    </a>
                    
                    <div class="about-us-img-info about-us-img-info-2 about-us-img-info-3">
                        
                        <div class="ltn__video-img ltn__animation-pulse1">
                            
                            {{-- <img src="{{ asset('assets/frontend') }}/img/others/8.png" alt="video popup bg image"> --}}
                            <img src="{{ asset($about_us?->secondery_image	?? 'uploads/default.jpg') }}" alt="video popup bg image">
                            
                            
                            @php
                                $videoUrl = $about_us?->video_url;
                                $videoId = null;

                                if ($videoUrl) {
                                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([^\s&]+)/', $videoUrl, $matches);
                                    $videoId = $matches[1] ?? null;
                                }
                                // dd($videoId);
                                // Set default if no video ID found
                                $videoId = $videoId ?: '4jnzf1yj48M'; // Default video ID
                            @endphp
                            <a class="ltn__video-icon-2 ltn__video-icon-2-border---" href="https://www.youtube.com/embed/{{ $videoId }}"  data-rel="lightcase:myCollection">
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="about-us-info-wrap">
                    <div class="section-title-area ltn__section-title-2--- mb-20">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">About Us</h6>
                        <h1 class="section-title">{{$about_us?->title }}<span>.</span></h1>
                        <p>{!!$about_us?->description !!}</p>
                    </div>
                    <ul class="ltn__list-item-half clearfix">
                        @foreach($about_us?->features ?? [] as $feature)
                            <li>
                                <i class="{{ $feature['icon'] }}"></i>
                                {{ $feature['title'] }}
                            </li>
                        @endforeach
                        {{-- <li>
                            <i class="flaticon-home-2"></i>
                            Smart Home Design
                        </li>
                        <li>
                            <i class="flaticon-mountain"></i>
                            Beautiful Scene Around
                        </li>
                        <li>
                            <i class="flaticon-heart"></i>
                            Exceptional Lifestyle
                        </li>
                        <li>
                            <i class="flaticon-secure"></i>
                            Complete 24/7 Security
                        </li> --}}
                    </ul>
                    <div class="ltn__callout bg-overlay-theme-05  mt-30">
                        <p>"{{$about_us?->quotation }}" </p>
                    </div>
                    {{-- <div class="btn-wrapper animated">
                        <a href="service.html" class="theme-btn-1 btn btn-effect-1">OUR SERVICES</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ABOUT US AREA END -->