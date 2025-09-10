<!-- PAGE DETAILS AREA START (blog-details) -->
<div class="ltn__page-details-area ltn__blog-details-area pt-60 mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">
                        <div class="ltn__blog-meta">
                            {{-- @dd($blog->blog_category) --}}
                            <ul>
                                <li class="ltn__blog-category">
                                    <a href="{{ $blog?->blog_category?->slug ? route('news_category', $blog?->blog_category?->slug) : route('home') }}">
                                        {{$blog?->blog_category?->title ?? 'Starlite'}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <h2 class="ltn__blog-title">{{ $blog->title ?? '' }}</h2>
                        <div class="ltn__blog-meta">
                            <ul>
                                <li class="ltn__blog-author">
                                    <a href="javascript:void(0)"><img src="{{ asset('uploads/default_man.jpeg') }}"
                                            alt="#">By: {{ $blog->writer ?? 'Admin' }}</a>
                                </li>
                                <li class="ltn__blog-date">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ optional($blog?->publish_date ?? $blog?->created_at ? \Carbon\Carbon::parse($blog?->publish_date ?? $blog?->created_at) : null)?->format('M d, Y') ?? 'N/A' }}
                                </li>
                                <li>
                                    <a href="#"><i class="far fa-comments"></i>{{count($blog?->comments ?? [])}} Comments</a>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ asset($blog?->thumbnail_image ?? 'uploads/default.jpg') }}" data-rel="lightcase:myCollection">
                            <img src="{{ asset($blog?->thumbnail_image ?? 'uploads/default.jpg') }}" alt="Image">
                        </a>
                          {!! ($blog?->description ?? '')!!}
                        
                    </div>
                    <hr>
                    <!-- related-post -->
                    {{-- <div class="related-post-area mb-50">
                        <h4 class="title-2">Related Post</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Blog Item -->
                                <div class="ltn__blog-item ltn__blog-item-6">
                                    <div class="ltn__blog-img">
                                        <a href="blog-details.html"><img
                                                src="{{ asset('assets/frontend') }}/img/blog/blog-details/11.jpg"
                                                alt="Image"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date ltn__secondary-color">
                                                    <i class="far fa-calendar-alt"></i>June 22, 2020
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="ltn__blog-title"><a href="blog-details.html">A series of iOS 7
                                                inspire
                                                vector icons sense.</a></h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Blog Item -->
                                <div class="ltn__blog-item ltn__blog-item-6">
                                    <div class="ltn__blog-img">
                                        <a href="blog-details.html"><img
                                                src="{{ asset('assets/frontend') }}/img/blog/blog-details/12.jpg"
                                                alt="Image"></a>
                                    </div>
                                    <div class="ltn__blog-brief">
                                        <div class="ltn__blog-meta">
                                            <ul>
                                                <li class="ltn__blog-date ltn__secondary-color">
                                                    <i class="far fa-calendar-alt"></i>June 22, 2020
                                                </li>
                                            </ul>
                                        </div>
                                        <h3 class="ltn__blog-title"><a href="blog-details.html">A series of iOS 7
                                                inspire
                                                vector icons sense.</a></h3>
                                        <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed doing.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- comment-area -->
                    <div class="ltn__comment-area mb-50">
                        {{-- <div class="ltn-author-introducing clearfix">
                            <div class="author-img">
                                <img src="{{ asset('assets/frontend') }}/img/blog/author.jpg" alt="Author Image">
                            </div>
                            <div class="author-info">
                                <h6>Written by</h6>
                                <h2>Rosalina D. William</h2>
                                <p>As we continue to grow, Starlite remains steadfast in its pursuit of excellence. We
                                    are actively expanding our footprint into new markets, exploring innovative building
                                    technologies</p>
                            </div>
                        </div> --}}
                        <h4 class="title-2">{{count($blog?->comments ?? [])}} Comments</h4>
                        <div class="ltn__comment-inner">
                            <ul>
                                {{-- <li>
                                    <div class="ltn__comment-item clearfix">
                                        <div class="ltn__commenter-img">
                                            <img src="{{ asset('assets/frontend') }}/img/testimonial/Khondker-Abul-Qasem3.png"
                                                alt="Image">
                                        </div>
                                        <div class="ltn__commenter-comment">
                                            <h6><a href="#">Adam Smit</a></h6>
                                            <span class="comment-date">20th May 2020</span>
                                            <p>As we continue to grow, Starlite remains steadfast in its pursuit of
                                                excellence. We are actively expanding our footprint into new markets.
                                            </p>
                                            <a href="#" class="ltn__comment-reply-btn"><i
                                                    class="icon-reply-1"></i>Reply</a>
                                        </div>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="ltn__comment-item clearfix">
                                                <div class="ltn__commenter-img">
                                                    <img src="{{ asset('assets/frontend') }}/img/testimonial/Kawser-Ali.png"
                                                        alt="Image">
                                                </div>
                                                <div class="ltn__commenter-comment">
                                                    <h6><a href="#">Adam Smit</a></h6>
                                                    <span class="comment-date">21th May 2020</span>
                                                    <p>As we continue to grow, Starlite remains steadfast in its pursuit
                                                        of excellence. </p>
                                                    <a href="#" class="ltn__comment-reply-btn"><i
                                                            class="icon-reply-1"></i>Reply</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li> --}}
                                @foreach ($blog?->comments ?? []  as $comment)
                                <li>
                                    <div class="ltn__comment-item clearfix">
                                        <div class="ltn__commenter-img">
                                            <img src="{{ asset('uploads/default_man.jpeg') }}"
                                                alt="Image">
                                        </div>
                                        <div class="ltn__commenter-comment">
                                            <h6><a href="#">{{$comment?->name ?? "Unknown"}}</a></h6>
                                            <span class="comment-date">{{ \Carbon\Carbon::parse($comment?->created_at)->format('d M Y') }}</span>
                                            <p>{{$comment?->comment}}</p>
                                            {{-- <a href="#" class="ltn__comment-reply-btn"><i
                                                    class="icon-reply-1"></i>Reply</a> --}}
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <!-- comment-reply -->
                    <div  id="commentFormWrapper" class="ltn__comment-reply-area ltn__form-box mb-60---">
                        <h4 class="title-2">Post Comment</h4>
                        <form id="comment_form" action="{{ route('blog_comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">

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
                                <button class="btn border theme-btn-1 btn-effect-1 text-uppercase" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('frontend.pages.news.component.blogsidebar')
        </div>
    </div>
</div>
<!-- PAGE DETAILS AREA END -->


@push('js_start')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($errors->any())
                setTimeout(function () {
                    const wrapper = document.getElementById('commentFormWrapper');
                    if (wrapper) {
                        wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }, 100); // Delay lets browser finish default scroll first
            @endif
        });
    </script>
@endpush