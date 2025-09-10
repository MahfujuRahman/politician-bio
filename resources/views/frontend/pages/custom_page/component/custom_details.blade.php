<!-- filepath: resources/views/frontend/pages/custom_page/component/custom_details.blade.php -->
<!-- PAGE DETAILS AREA START (blog-details) -->
<div class="ltn__page-details-area ltn__blog-details-area pt-60 mb-120">
    <div class="container">
        <!-- Banner Section -->
        @if(!empty($custom_page?->banner_image))
            <div class="mb-4 position-relative">
                <img src="{{ asset($custom_page->banner_image) }}" alt="Banner Image" class="img-fluid w-100" style="max-height:350px;object-fit:cover;">
                <div class="position-absolute w-100 h-100" style="top:0;left:0;background:rgba(0,0,0,0.5);"></div>
                <h1 class="text-center position-absolute w-50" style="top:50%;left:50%;transform:translate(-50%, -50%);color:white;padding:10px;font-size:4rem;font-weight:bold;text-shadow:2px 2px 5px rgba(0,0,0,0.5);background:rgba(0,0,0,0.3);border-radius:8px;">
                    {{ $custom_page?->title ?? '' }}
                </h1>
            </div>
        @endif

        <!-- Title Section -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__blog-details-wrap">
                    <div class="ltn__page-details-inner ltn__blog-details-inner">
                       
                        <!-- Text Editor Content -->
                        <div class="mb-4">
                            {!! $custom_page->description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE DETAILS AREA END -->