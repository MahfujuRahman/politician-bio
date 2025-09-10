<!-- BLOG AREA START -->
<div class="ltn__blog-area pt-60 mb-120">
    <div class="container">
        <div class="row">
           
            <div class="col-lg-8">
                <div class="text-center ">
                    @if (request()->routeIs('news_category'))
                        <h2 class="pb-20">{{ ucfirst($category->title ?? '') }} Blog</h2>
                    @else
                        {{-- <h2>Blogs</h2> --}}
                    @endif
    
                </div>
                <div class="ltn__blog-list-wrap">
                    <!-- Blog Item -->
                    @foreach ($blogs as $blog)
                        <div class="ltn__blog-item ltn__blog-item-5">
                            <div class="ltn__blog-img">
                                <a href="{{ route('news_details', $blog->slug) }}">
                                    <img src="{{ asset($blog->thumbnail_image ?? 'assets/frontend/img/blog/31.jpg') }}"
                                        alt="Image">
                                </a>
                            </div>
                            <div class="ltn__blog-brief">
                                <div class="ltn__blog-meta">
                                    {{-- @dd($blog?->blog_category?->slug) --}}
                                    @php
                                        $category = $blog->blog_category ?? null;
                                    @endphp
                                    <ul>
                                        <li class="ltn__blog-category">
                                            <a href="{{ $category ? route('news_category', $category->slug) : '#' }}">
                                                {{ request()->routeIs('news_category') ? $blog->category_name : ($category->title ?? 'Starlit') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <h2 class="ltn__blog-title">{{ $blog?->title ?? '' }}</h2>
                                <div class="ltn__blog-meta">
                                    <ul>
                                        {{-- <li>
                                            <a href="#"><i class="far fa-eye"></i>232 Views</a>
                                        </li> --}}
                                        <li>
                                            <a href="#"><i class="far fa-comments"></i>{{count($blog?->comments ?? [])}} Comments</a>
                                        </li>
                                        <li class="ltn__blog-date">
                                            <i class="far fa-calendar-alt"></i>
                                            {{ optional($blog?->publish_date ?? $blog?->created_at)
                                                ? \Carbon\Carbon::parse($blog?->publish_date ?? $blog?->created_at)->format('M d, Y')
                                                : 'N/A' }}
                                        </li>
                                    </ul>
                                </div>
                                <p>
                                    {!! \Illuminate\Support\Str::limit(strip_tags($blog?->description ?? ''), 200) !!}
                                </p>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        <ul>
                                            <li class="ltn__blog-author">
                                                <a href="#"><img src="{{ asset('uploads/default_man.jpeg') }}"
                                                        alt="#">By: {{ $blog?->writer ?? 'Admin' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a href="{{ route('news_details', $blog->slug) }}"><i
                                                class="fas fa-arrow-right"></i>Read
                                            more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Blog Item End -->
                </div>
                @if ($blogs->isEmpty())
                    <div class="alert alert-info text-center my-4">
                        No news articles found.
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ltn__pagination-area text-center">
                                <div class="ltn__pagination">
                                    <ul>
                                        {{-- Previous Page Link --}}
                                        @if ($blogs->onFirstPage())
                                            <li><a href="{{ $blogs->url(1) }}"><i class="fas fa-angle-double-left"></i></a></li>
                                        @else
                                            <li>
                                                <a href="{{ $blogs->previousPageUrl() }}"><i
                                                        class="fas fa-angle-double-left"></i></a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                            @if ($page == $blogs->currentPage())
                                                <li class="active"><a href="#">{{ $page }}</a></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($blogs->hasMorePages())
                                            <li>
                                                <a href="{{ $blogs->nextPageUrl() }}"><i
                                                        class="fas fa-angle-double-right"></i></a>
                                            </li>
                                        @else
                                            <li><a href="{{ $blogs->url($blogs->lastPage()) }}"><i
                                                        class="fas fa-angle-double-right"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @include('frontend.pages.news.component.blogsidebar')
        </div>
    </div>
</div>
<!-- BLOG AREA END -->