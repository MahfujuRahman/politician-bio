<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @php
        // Helper function to get meta value from $settingTitles
        if (!function_exists('get_meta_value')) {
            function get_meta_value($setting) {
                return $setting?->values?->first()?->value ?? '';
            }
        }
        $meta_title = get_meta_value($settingTitles->where('title', 'meta_title')->first()) ?: 'Starlit Homes Ltd &#8211; Exclusive Real Estate Developer';
        $meta_description = get_meta_value($settingTitles->where('title', 'meta_description')->first());
        $meta_keywords = get_meta_value($settingTitles->where('title', 'meta_keywords')->first());
        $canonical_url = get_meta_value($settingTitles->where('title', 'canonical_url')->first());
    @endphp

    <title>{{ $meta_title }}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="{{ $meta_description }}">
    <meta name="keywords" content="{{ $meta_keywords }}">
    @if(!empty($canonical_url))
        <link rel="canonical" href="{{ $canonical_url }}">
    @endif
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('/assets/frontend') }}/img/favicon.png" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/style.css?v=1">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/responsive.css?v=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/custom.css?v=1">
</head>

<body>
    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        <!-- HEADER AREA START -->
        @if (Request::is('/'))
            @include('frontend.layouts.includes.header')
        @else
            @include('frontend.layouts.includes.header2')
        @endif
        <!-- HEADER AREA END -->



        @yield('content')


        <!-- FOOTER AREA START -->
        @include('frontend.layouts.includes.footer')
        <!-- FOOTER AREA END -->
        <!-- MODAL AREA START (Quick View Modal) -->
        @include('frontend.layouts.includes.modal')
        <!-- MODAL AREA END -->
        <!-- Body main wrapper end -->
    </div>

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    <!-- JavaScript -->
    @stack('js_start')
    <script>
        // Function to set active button
        function setActive(button) {
            // Remove 'active' class from all buttons
            const buttons = document.querySelectorAll('.nav-link');
            buttons.forEach(btn => btn.classList.remove('active'));
            // Add 'active' class to the clicked button
            button.classList.add('active');

            // Get filter value
            const filter = button.getAttribute('data-filter');

            // Show/hide product items
            document.querySelectorAll('.image_container').forEach(item => {
                // Get the category of the item
                const category = item.getAttribute('data-category');
                // Check if the item matches the filter
                if (filter === 'all') {
                    item.style.display = '';
                } else if (category === filter) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- All JS Plugins -->
    <script src="{{ asset('assets/frontend') }}/js/plugins.js"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/frontend') }}/js/main.js"></script>

</body>

</html>
