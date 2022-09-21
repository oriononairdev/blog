@if ($post->tweet_url)
    <div class="markup mt-16">
        <div
            class="sm:mx-0 p-4 sm:p-6 md:p-8 bg-gray-100 border-b-5 border-blue-200 text-sm text-gray-700 mb-8 hover:shadow">
            <a target="_blank" class="!text-indigo-300" href="{{ $post->tweet_url }}">Bu tweete</a> cevap
            yazarak @if($post->isDev()) da @endif bu
            yazıya yorum yapabilirsiniz.

            @if(count($post->webmentions) === 0)
                <br/>
                <br/>
                Bütün cevaplar, retweetler ve beğeniler aşağıda gözükecektir.
            @endif
        </div>
    </div>
@endif
@if(count($post->webmentions) > 0)
    {{--<div class="markup mb-8">
        <h2 id="webmentions">
            Webmentions
            <a href="#webmentions" class="permalink">#</a>
        </h2>
    </div>--}}
    @foreach($post->webmentions as $webmention)
        <div class="mb-6 text-sm">
            <div class="flex items-center">
                <div class="mr-2">
                    <img class="h-8 w-8 rounded-full mx-auto" src="{{ $webmention->author_photo_url }}"/>
                </div>
                <div>
                    <a class="font-semibold" href="{{ $webmention->author_url }}">{{ $webmention->author_name }}</a>
                    <span class="text-gray-700">
                <a class="underline"
                   href="{{ $webmention->interaction_url }}">{{ __('blog.webmention.'.$webmention->verb) }}</a> - {{ $webmention->created_at->diffForHumans() }}
            </span>
                </div>
            </div>

            @if ($webmention->type === \App\Models\Webmention::TYPE_REPLY && $webmention->text)
                <div class="mt-2">
                    {{ $webmention->text }}
                </div>
            @endif
        </div>
    @endforeach
@endif
