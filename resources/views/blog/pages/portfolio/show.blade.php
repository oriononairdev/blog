@extends('blog.layouts.master')
@section('soloTitle'){{$project->title}} - Portfolio | Mücahit Uğur @endsection
@section('content')
    <article class="prose leading-relaxed text-justify">
        <header class="mb-6 flex-wrap">
            <h1 class="-mb-4 leading-tight">{{ $project->title }}</h1>
            @include('blog.pages.portfolio.partials.bar')
        </header>
        <p>{!! $project->summary_html !!}</p>
        @if($project->description_html)
            <h2>{{ __('blog.portfolio.show.overview') }}</h2>
            <p>{!! $project->description_html !!}</p>
        @endif
        @foreach($project->media as $media)
            <figure class="mt-12 mb-8 relative mx-auto my-auto text-center pb-7/12 lg:pb-0">
                @if(\Illuminate\Support\Str::contains($media->mime_type, 'video'))
                    <video class="aspect-w-16 rounded shadow-md hover:shadow-xl justify-center mx-auto my-auto"
                           controls>
                        <source src="{{$media->getUrl()}}" type="{{$media->mime_type}}">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <img class="rounded justify-center mx-auto my-auto" src="{{$media->getUrl()}}"
                         loading="lazy" alt="{{$media->name}}">
                @endif
                @if($media->hasCustomProperty('description'))
                    <figcaption class="flex text-sm justify-center text-gray-500 dark:text-black">
                        <svg viewBox="0 0 20 20" fill="currentColor"
                             class="flex-none w-5 h-5 mr-2 text-gray-400 dark:text-black">
                            <path fill-rule="evenodd"
                                  d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        {{$media->getCustomProperty('description')}}
                    </figcaption>
                @endif
            </figure>
        @endforeach
    </article>
    @include('blog.pages.portfolio.partials.taglist')
@endsection
