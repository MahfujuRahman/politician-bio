<!-- BLOG AREA START (blog-3) -->
<div class="ltn__blog-area pt-115--- pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2--- text-center">
                    <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Blogs</h6>
                    <h1 class="section-title">Latest Blogs</h1>
                </div>
            </div>
        </div>
        <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
            <!-- Blog Item -->
            @foreach ($blogs as $blog)
                <div class="col-lg-4">
                    <div class="ltn__blog-item ltn__blog-item-3">
                        <div class="ltn__blog-img">
                            <a href="{{ route('news_details', $blog->slug) }}"><img class="blog_img_custom" src="{{ asset($blog?->thumbnail_image) }}" alt="#"></a>
                        </div>
                        <div class="ltn__blog-brief">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-author">
                                        <a href="#"><i class="far fa-user"></i>by: {{ $blog?->writer ?? 'Admin'}}</a>
                                    </li>
                                    <li class="ltn__blog-tags">
                                        <a href="#"><i class="fas fa-tags"></i>{{ $blog?->tags ?? 'No Tag'}}</a>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="ltn__blog-title"><a href="{{ route('news_details', $blog->slug) }}">{{ $blog?->title }}</a></h3>
                            <div class="ltn__blog-meta-btn">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>{{ optional($blog?->publish_date ?? $blog?->created_at ? \Carbon\Carbon::parse($blog?->publish_date ?? $blog?->created_at) : null)?->format('M d, Y') ?? 'N/A' }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="ltn__blog-btn">
                                    <a href="{{ route('news_details', $blog->slug) }}">Read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Blog Item -->
            {{-- <div class="col-lg-4">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ route('news_details') }}"><img src="{{ asset('assets/frontend') }}/img/blog/2.jpg" alt="#"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                </li>
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>Interior</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="ltn__blog-title"><a href="{{ route('news_details') }}">The Most Inspiring Interior Design Of 2021</a></h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>July 23, 2021</li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="{{ route('news_details') }}">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Blog Item -->
            {{-- <div class="col-lg-4">
                <div class="ltn__blog-item ltn__blog-item-3">
                    <div class="ltn__blog-img">
                        <a href="{{ route('news_details') }}"><img src="{{ asset('assets/frontend') }}/img/blog/3.jpg" alt="#"></a>
                    </div>
                    <div class="ltn__blog-brief">
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="#"><i class="far fa-user"></i>by: Admin</a>
                                </li>
                                <li class="ltn__blog-tags">
                                    <a href="#"><i class="fas fa-tags"></i>Estate</a>
                                </li>
                            </ul>
                        </div>
                        <h3 class="ltn__blog-title"><a href="{{ route('news_details') }}">Recent Commercial Real Estate Transactions</a></h3>
                        <div class="ltn__blog-meta-btn">
                            <div class="ltn__blog-meta">
                                <ul>
                                    <li class="ltn__blog-date"><i class="far fa-calendar-alt"></i>May 22, 2021</li>
                                </ul>
                            </div>
                            <div class="ltn__blog-btn">
                                <a href="{{ route('news_details') }}">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- BLOG AREA END -->