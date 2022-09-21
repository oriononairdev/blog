@extends('blog.layouts.master')
@section('title'){{__('blog.category.'.$category->lowername)}}@endsection
@section('content')
    @include('blog.partials.postlist')
@endsection
@section('seo')
    <meta property="og:title" content="{{ $category->name }} | mucahitugur.com"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $category->name }} | mucahitugur.com"/>
    <meta name="twitter:site" content="@oriononair"/>
    <meta name="twitter:creator" content="@oriononair"/>
@endsection
