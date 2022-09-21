@extends('blog.layouts.master')
@section('title'){{$page->title}}@endsection
@section('content')

    @if($page->setup['title'] ?? true)
        <div class="markup | mb-4">
            <h1>{{__('blog.'.$page->lowertitle.'.title')}}</h1>
        </div>
    @endif

    @if($page->setup['description'] ?? false)
        @include('blog.partials.page-description',['description'=>$page->description])
    @endif

    @if($page->setup['postlist'] ?? false)
        @include('blog.partials.postlist')
    @endif

    @if($page->content)
        <div class="markup | mb-8">
            <p>{!!$page->content!!}</p>
        </div>
    @endif


    @if($page->widgets['newsletter'] ?? false)
        @include('blog.widgets.newsletter')
    @endif


    @if($page->widgets['comments'] ?? false)
        <div class="mb-8">
            @include('blog.widgets.comments')
        </div>
    @endif

@endsection
@section('seo')
    <meta property="og:title" content="{{ $page->title }} | mucahitugur.com"/>
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit($page->description, 150) }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit($page->description, 150) }}"/>
    <meta name="twitter:title" content="{{ $page->title }} | mucahitugur.com"/>
    <meta name="twitter:site" content="@oriononair"/>
    <meta name="twitter:creator" content="@oriononair"/>
@endsection
