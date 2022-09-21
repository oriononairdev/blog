@extends('blog.layouts.master')
@section('title'){{$post->title}}@endsection
@section('content')
    <article class="mb-8">
        <div class="mb-5" style="
            height: 6px;
            background-color: {{$post->color}};
            box-shadow: 0 3px 0 {{$post->color}}dd, 0 3px 0 #000;
            "></div>
        @if(!empty($post->featured_image))<img src="{{$post->featured_image}}" class="mb-5" alt=""/>@endif
        <header class="mb-6">
            {{-- Title --}}
            <h1 class
                ="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">
                {{$post->title}}
            </h1>
            {{-- Post Details --}}
            <p class="text-sm text-gray-700">
                {{-- Post Type --}}
                {{__('blog.type.'.$post->typelower)}}
                {{-- Post Category --}}
                – <a href="{{route('blog.category',$post->category->slug)}}">
                    {{__('blog.category.'.$post->category->lowername)}}
                </a>
                {{-- Post Publish Date --}}
                – <a href="{{route('blog.single',[$post->id,$post->slug])}}">
                    <time datetime="{{$post->published_at}}">
                        {{$post->published_at->format('m/d/Y')}}
                    </time>
                </a>
                @if(auth()->user() && auth()->user()->is_admin)
                - <a class="opacity-75 text-gray-800 hover:text-gray-600 font-semibold transition duration-1000"
                     href="{{route('blog.admin.posts.edit', $post->id)}}"
                     target="_blank">[{{ __('blog.post.edit') }}]</a>
                @endif
            </p>
        </header>
        <div class="markup leading-relaxed mb-8 text-justify">
            {!!$post->summary!!}
            <p></p>
            @if ($post->external_url)
                <a target="{{$post->external_url ? '_blank':''}}" class="text-blue-700 underline"
                   href="{{ $post->external_url }}">
                    {{ __('blog.post.readmore') }}</a>
                <span class="text-xs text-gray-700">[{{ $post->domain }}]</span>
            @else
                {!!$post->content!!}
            @endif
        </div>
        {{--@if($post->tags->pluck('name'))
            <div class="mb-4">
            @foreach($post->tags->pluck('name') as $tag)
                <a target="_blank" href="{{route('blog.tag',str_contains($tag, '#') ? str_replace('#','%23',$tag):$tag)}}">
                    <span
                        class="mb-1 @unless($loop->first) ml-1 @endunless inline-flex items-center px-2 py-0.5 rounded text-sm font-medium bg-indigo-100 hover:bg-indigo-50 text-indigo-800">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-indigo-400" fill="currentColor" viewBox="0 0 8 8">
                     <circle cx="4" cy="4" r="3"/>
                    </svg>
                    {{$tag}}
                    </span>
                </a>
            @endforeach
            </div>
        @endif--}}
    </article>
    {{--@if((bool)random_int(0, 1))
        @include('blog.widgets.newsletter')
    @endif--}}
    <div class="mb-8">
        @include('blog.widgets.comments')
        @include('blog.widgets.webmentions')
    </div>
@endsection
@section('seo')
    <link rel="canonical" href="{{ $post->url }}" />
    <meta property="og:title" content="{{ $post->title }} | mucahitugur.com"/>
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit($post->plainsummary, 150) }}"/>
    <meta name="description" content="{{ \Illuminate\Support\Str::limit($post->plainsummary, 150) }}"/>
    <meta property="og:url" content="{{ $post->url }}">
    <meta name="og:image" content="{{ url($post->getFirstMediaUrl('blog_images')) }}"/>
    @foreach($post->tags as $tag)
        <meta property="article:tag" content="{{ $tag->name }}"/>
    @endforeach
    <meta property="article:published_time" content="{{ optional($post->published_at)->toIso8601String() }}"/>
    <meta property="og:updated_time" content="{{ $post->updated_at->toIso8601String() }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="{{ $post->plainsummary }}"/>
    <meta name="twitter:title" content="{{ $post->title }}"/>
    <meta name="twitter:site" content="@oriononair"/>
    <meta name="twitter:image" content="{{ url($post->getFirstMediaUrl('blog_images')) }}"/>
    <meta name="twitter:creator" content="@oriononair"/>
@endsection
