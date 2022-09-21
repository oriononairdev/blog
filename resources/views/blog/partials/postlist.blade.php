@if($posts->isEmpty() || !\App\Models\BlogPost::published()->localized()->exists())
    @include('blog.partials.page-description', ['description' => __('blog.post.none')])
@endif

@foreach($posts as $post)
    <article class="mb-12 md:mb-24&#039;">
        <div class="mb-5" style="
            height: 6px;
            background-color: {{$post->color}};
            box-shadow: 0 3px 0 {{$post->color}}dd, 0 3px 0 #000;
            "></div>
        <header class="mb-6">
            @if($post->is_pinned)<small
                class="w-5 h-5 hover:bg-yellow-200 rounded-lg shadow-md hover:shadow-lg bg-gray-200"
                title="{{__('blog.post.pinned')}}">📌</small>@endif
            <h2 class
                ="max-w-lg text-2xl md:text-3xl font-extrabold leading-tight mb-1">
                <a target="{{$post->isLink() ? '_blank':''}}"
                   href="{{$post->isLink() ? $post->external_url:$post->url}}">{{$post->title}}</a>
            </h2>
            <p class="text-sm text-gray-700">
                {{__('blog.type.'.$post->typelower)}} – <a
                    href="{{route('blog.category',$post->category->slug)}}">{{__('blog.category.'.$post->category->lowername)}}</a>
                –
                <a href="{{$post->url}}">
                    <time datetime="{{$post->published_at}}">
                        {{$post->published_at->diffForHumans()}}
                    </time>
                </a>
                {{-- Show author if post is not original --}}
                @if(!$post->isOriginal()) – {{$post->author}} @endif
                {{--$post->type !== 'Link' ? '– '.$post->reading_time.' Dakika':''--}}
                {{$post->external_url ? '– '.$post->domain:''}}
            </p>
        </header>
        <div class="markup leading-relaxed">
            {!!$post->summary!!}
            <p class="mt-6">
                @if($post->isLink())
                    <a href="{{ $post->external_url }}">
                        {{ __('blog.post.readmore') }}</a>
                    <span class="text-xs text-gray-700">[{{ $post->domain }}]</span>
                @else
                    <a href="{{ $post->url }}">
                        {{ __('blog.post.readmore') }}
                    </a>
                @endif
            </p>
        </div>
    </article>
@endforeach
{{$posts->links()}}
