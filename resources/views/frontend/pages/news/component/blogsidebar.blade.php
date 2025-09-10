<div class="col-lg-4">
    <aside class="sidebar-area blog-sidebar ltn__right-sidebar">
        <!-- Author Widget -->
        {{-- <div class="widget ltn__author-widget">
            <div class="ltn__author-widget-inner text-center">
                <img src="{{ asset('assets/frontend') }}/img/team/4.jpg" alt="Image">
                <h5>Engr. Kazi Abid Hasan</h5>
                <small>Traveller/Photographer</small>
                <div class="product-ratting">
                    <ul>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                        <li><a href="#"><i class="far fa-star"></i></a></li>
                        <li class="review-total"> <a href="#"> ( 1 Reviews )</a></li>
                    </ul>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis distinctio, odio, eligendi
                    suscipit reprehenderit atque.</p>
                <div class="ltn__social-media">
                    <ul>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>

                        <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div> --}}

        <div class="widget ltn__search-widget position-relative">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Search Blogs</h4>
            <input type="text" id="blog-search" placeholder="Search blog title...">

            <!-- Result area -->
            <div id="search-results" class="search-results-box d-none">

            </div>
        </div>


        <!-- Form Widget -->
        {{-- <div class="widget ltn__form-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Drop Messege For Book</h4>
            <form action="#">
                <input type="text" name="yourname" placeholder="Your Name*">
                <input type="text" name="youremail" placeholder="Your e-Mail*">
                <textarea name="yourmessage" placeholder="Write Message..."></textarea>
                <button type="submit" class="btn theme-btn-1">Send Messege</button>
            </form>
        </div> --}}

        <!-- Top Rated Product Widget -->
        <div class="widget ltn__top-rated-product-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Rated Blog</h4>
            <ul>
                @foreach ($top_rated_blogs as $blog)
                    <li>
                        <div class="top-rated-product-item clearfix">
                            <div class="top-rated-product-img">
                                <a href="{{ route('news_details', $blog->slug) }}">
                                    <img src="{{ asset($blog->thumbnail_image ?? 'assets/frontend/img/blog/31.jpg') }}"
                                        alt="Image">
                                </a>
                            </div>
                            <div class="top-rated-product-info">
                                {{-- <div class="product-ratting">
                                    <ul>
                                        @php
                                            // Generate a fixed order: full stars, then half, then empty
                                            $stars = [];
                                            $fullStars = rand(0, 5);
                                            $halfStar = ($fullStars < 5 && rand(0, 1)) ? 1 : 0;
                                            $emptyStars = 5 - $fullStars - $halfStar;

                                            for ($i = 0; $i < $fullStars; $i++) {
                                                $stars[] = '<li><a href="#"><i class="fas fa-star"></i></a></li>';
                                            }
                                            if ($halfStar) {
                                                $stars[] = '<li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>';
                                            }
                                            for ($i = 0; $i < $emptyStars; $i++) {
                                                $stars[] = '<li><a href="#"><i class="far fa-star"></i></a></li>';
                                            }
                                        @endphp
                                        {!! implode('', $stars) !!}
                                    </ul>
                                </div> --}}
                                <h6><a href="{{ route('news_details', $blog->slug) }}">{{ $blog->title }}</a></h6>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Menu Widget (Category) -->
        <div class="widget ltn__menu-widget ltn__menu-widget-2--- ltn__menu-widget-2-color-2---">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Top Categories</h4>
            <ul>
                @foreach ($blog_category as $category)
                    <li><a href="{{ route('news_category', $category->slug) }}">{{ $category->title ?? ''}}
                            <span>{{ $category->blog_count ?? 0}}</span></a></li>
                @endforeach
            </ul>
        </div>
        <!-- Popular Product Widget -->
        {{-- <div class="widget ltn__popular-product-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Popular Properties</h4>
            <div class="row ltn__popular-product-widget-active slick-arrow-1">
                <!-- ltn__product-item -->
                <div class="col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/6.jpg"
                                    alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img
                                            src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens,
                                            Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bedrooms
                                </li>
                                <li><span>2 </span>
                                    Bathrooms
                                </li>
                                <li><span>3450 </span>
                                    square Ft
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/4.jpg"
                                    alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img
                                            src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens,
                                            Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bedrooms
                                </li>
                                <li><span>2 </span>
                                    Bathrooms
                                </li>
                                <li><span>3450 </span>
                                    square Ft
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-12">
                    <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                        <div class="product-img">
                            <a href="product-details.html"><img src="{{ asset('assets/frontend') }}/img/product-3/5.jpg"
                                    alt="#"></a>
                            <div class="real-estate-agent">
                                <div class="agent-img">
                                    <a href="team-details.html"><img
                                            src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="#"></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-price">
                                <span>$349,00<label>/Month</label></span>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                            <div class="product-img-location">
                                <ul>
                                    <li>
                                        <a href="product-details.html"><i class="flaticon-pin"></i> Belmont Gardens,
                                            Chicago</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                <li><span>3 </span>
                                    Bedrooms
                                </li>
                                <li><span>2 </span>
                                    Bathrooms
                                </li>
                                <li><span>3450 </span>
                                    square Ft
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div> --}}
        <!-- Popular Post Widget -->
        <div class="widget ltn__popular-post-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Latest Blogs</h4>
            <ul>
                @foreach ($latest_blogs as $blog)
                    <li></li>
                    <div class="popular-post-widget-item clearfix">
                        <div class="popular-post-widget-img">
                            <a href="{{ route('news_details', $blog->slug) }}">
                                <img src="{{ asset($blog->thumbnail_image ?? 'assets/frontend/img/blog/31.jpg') }}"
                                    alt="Image">
                            </a>
                        </div>
                        <div class="popular-post-widget-brief">
                            <h6>
                                <a href="{{ route('news_details', $blog->slug) }}">
                                    {{ \Illuminate\Support\Str::limit($blog->title ?? '', 50) }}
                                </a>
                            </h6>
                            </h6>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date">
                                        <a href="#"><i class="far fa-calendar-alt"></i>
                                            {{ optional($blog?->publish_date ?? $blog?->created_at ? \Carbon\Carbon::parse($blog?->publish_date ?? $blog?->created_at) : null)?->format('M d, Y') ?? 'N/A' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </li>

                @endforeach

            </ul>
        </div>
        <!-- Popular Post Widget (Twitter Post) -->
        {{-- <div class="widget ltn__popular-post-widget ltn__twitter-post-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Twitter Feeds</h4>
            <ul>
                <li>
                    <div class="popular-post-widget-item clearfix">
                        <div class="popular-post-widget-img">
                            <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="popular-post-widget-brief">
                            <p>Carsafe - #Gutenberg ready
                                @wordpress
                                Theme for Car Service, Auto Parts, Car Dealer available on
                                @website
                                <a href="https://website.net/">https://website.net</a>
                            </p>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date">
                                        <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="popular-post-widget-item clearfix">
                        <div class="popular-post-widget-img">
                            <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="popular-post-widget-brief">
                            <p>Carsafe - #Gutenberg ready
                                @wordpress
                                Theme for Car Service, Auto Parts, Car Dealer available on
                                @website
                                <a href="https://website.net/">https://website.net</a>
                            </p>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date">
                                        <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="popular-post-widget-item clearfix">
                        <div class="popular-post-widget-img">
                            <a href="blog-details.html"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="popular-post-widget-brief">
                            <p>Carsafe - #Gutenberg ready
                                @wordpress
                                Theme for Car Service, Auto Parts, Car Dealer available on
                                @website
                                <a href="https://website.net/">https://website.net</a>
                            </p>
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date">
                                        <a href="#"><i class="far fa-calendar-alt"></i>June 22, 2020</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div> --}}
        <!-- Social Media Widget -->
        <div class="widget ltn__social-media-widget">
            <h4 class="ltn__widget-title ltn__widget-title-border-2">Follow us</h4>
            <div class="ltn__social-media-2">
                @php
                    $whatsapp = optional($settingTitles->where('title', 'whatsapp')->first())->values[0]->value ?? null;
                    $facebook = optional($settingTitles->where('title', 'facebook')->first())->values[0]->value ?? null;
                    $instagram = optional($settingTitles->where('title', 'instagram')->first())->values[0]->value ?? null;
                    $linkedin = optional($settingTitles->where('title', 'linkedin')->first())->values[0]->value ?? null;
                    $youtube = optional($settingTitles->where('title', 'youtube')->first())->values[0]->value ?? null;
                @endphp
                <ul>
                    @if ($facebook)
                        <li><a href="{{ $facebook }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if ($whatsapp)
                        <li>
                            <a href="https://wa.me/{{ preg_replace('/^\+?0*|\s+/', '', $whatsapp) }}" title="Whatsapp" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </li>
                    @endif
                    @if ($linkedin)
                        <li><a href="{{ $linkedin }}" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if ($youtube)
                        <li><a href="{{ $youtube }}" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                    @endif
                    @if ($instagram)
                        <li><a href="{{ $instagram }}" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    @endif

                </ul>
            </div>
        </div>
        <!-- Instagram Widget -->
        <div class="widget ltn__instagram-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Instagram Feeds</h4>
            <div class="ltn__instafeed ltn__instafeed-grid insta-grid-gutter"></div>
        </div>
    </aside>
</div>

@push('js_start')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const input = document.getElementById("blog-search");
        const resultsBox = document.getElementById("search-results");

        input.addEventListener("input", function () {
            const query = input.value.trim();

            if (query.length < 2) {
                resultsBox.classList.add("d-none");
                resultsBox.innerHTML = "";
                return;
            }

            fetch(`/blog/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    resultsBox.innerHTML = "";
                    if (data.length > 0) {
                        data.forEach(blog => {
                            const item = document.createElement("div");
                            item.classList.add("search-result-item", "p-2", "border-bottom");
                            item.innerHTML = `<a href="/news/details/${blog.slug}">${blog.title}</a>`;
                            resultsBox.appendChild(item);
                        });
                        resultsBox.classList.remove("d-none");
                    } else {
                        resultsBox.innerHTML = "<div class='p-2'>No results found</div>";
                        resultsBox.classList.remove("d-none");
                    }
                });
        });

        document.addEventListener("click", function (e) {
            if (!resultsBox.contains(e.target) && e.target !== input) {
                resultsBox.classList.add("d-none");
            }
        });
    });
</script>

@endpush