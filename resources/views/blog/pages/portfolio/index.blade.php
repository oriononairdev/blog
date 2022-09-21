@extends('blog.layouts.master')
@section('soloTitle')
    @if(isset($tag)) {{ucfirst($tag)}} Developer Mücahit Uğur @else {{ __('blog.portfolio.title') }} | Mücahit Uğur @endif @endsection
@section('content')
    @if($portfolio->isEmpty())
        @include('blog.partials.page-description', ['description' => __('blog.portfolio.project.none')])
    @endif

    @foreach($portfolio as $project)
        <article class="mb-12 md:mb-24">
            <div class="mb-5" style="
                height: 3px;
                background-color: {{$project->color}};
                box-shadow: 0 3px 0 {{$project->color}}dd, 0 3px 0 #000;
                "></div>
            <header class="mb-6 flex-wrap">
                @if($project->is_pinned)
                    <small
                        class="w-4 h-4 mt-2 hover:bg-yellow-200 rounded-lg shadow-md hover:shadow-lg bg-gray-200"
                        title="{{__('blog.post.pinned')}}">📌 <br/>
                    </small>
                @endif
                @if($project->type)
                    <a class="text-xxs leading-6 hover:text-sky-900 dark:text-black font-semibold tracking-tight uppercase transition ease-in-out duration-150">
                        {{$project->type}}
                    </a>
                @endif
                <h2 class
                    ="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">
                    {{$project->title}}
                </h2>
                @include('blog.pages.portfolio.partials.bar')
            </header>
            <div class="markup leading-relaxed">
                {!! $project->summary_html !!}
                {{--<p class="mt-6">
                    <a href="{{ 'proje linki' }}" class="text-md">
                        {{ __('blog.portfolio.readmore') }}
                    </a>
                </p>--}}
                {{--<p class="space-x-2 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <time datetime="{{$project->published_at}}" class="text-sm">
                        {{$project->published_at->translatedFormat('F Y')}}
                    </time>
                </p>--}}
                <a href="{{$project->internal}}"
                   class="group"
                   title="{{ __('blog.portfolio.readmore') }}">
                    <div
                        class="flex text-sm text-gray-600 hover:text-gray-500 underline-offset-4 decoration-2 decoration-orange-500 underline space-x-0">
                        {{ __('blog.portfolio.readmore') }}
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4 text-orange-500 group-hover:text-orange-500 group-hover:scale-105 group-hover:animate-pulse"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                            <path
                                d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
                        </svg>
                    </div>
                </a>
            </div>
            @php $media = $project->getFirstMedia('portfolio') @endphp
            @if($media)
                <figure class="mt-8 mb-2 relative pb-7/12 lg:pb-0">
                    @if(\Illuminate\Support\Str::contains($media->mime_type, 'video'))
                        <video class="aspect-w-16 rounded shadow-md hover:shadow-xl" controls>
                            <source src="{{$media->getUrl()}}" type="{{$media->mime_type}}">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <img class="rounded" src="{{$media->getUrl()}}"
                             loading="lazy" alt="{{$media->name}}">
                    @endif
                    @if($media->hasCustomProperty('description'))
                        <figcaption class="flex mt-3 text-sm text-gray-500 dark:text-black">
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
            @endif
            @include('blog.pages.portfolio.partials.taglist')
        </article>
    @endforeach
    {{$portfolio->links()}}
@endsection
