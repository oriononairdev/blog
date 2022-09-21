@extends('blog.layouts.master')
{{--@section('title'){{ __('blog.home.title') }}@endsection--}}
@section('content')
    @if(!$posts->isEmpty())
        @include('blog.partials.postlist')
    @else
        @include('blog.partials.page-description', ['description' => __('blog.home.none')])
    @endif
@endsection
