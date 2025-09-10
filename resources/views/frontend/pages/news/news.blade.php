@extends('frontend.layouts.frontend')

@push('custom_css')
    <link rel="stylesheet" href="{{ asset('/assets/frontend') }}/css/blog.css">
@endpush

@section('content')
    @include('frontend.pages.news.component.newsnav')
    @include('frontend.pages.news.component.newslist')
    @include('frontend.pages.news.component.action')
@endsection

@push('custom_js')
    <script> const blogSearchUrl = "{{ route('ajax.blog.search') }}"; </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/frontend/js/blog.js') }}"></script>
@endpush