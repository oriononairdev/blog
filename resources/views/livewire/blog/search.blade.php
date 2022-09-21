<div>
    <label for="search" class="hidden">{{__('blog.search.placeholder')}}</label>
    <input wire:model="query"
           type="text"
           autofocus
           id="search"
           placeholder="{{__('blog.search.placeholder')}}"
           class="bg-gray-100 px-3 pb-2 pt-3 w-full focus:outline-none border-gray-200 focus:border-gray-300 border-t-4 border-b-4 border-t-transparent mb-4">

    @if ($query === 'mellon')
        🌳 Welcome friend! 🌳
    @else
        @if ($query !== '')
            @if (count($results))
                <ul>
                    @foreach($results as $post)
                        <li class="mb-6">
                            <strong class="text-lg">
                                <a href='{{route('blog.single',[$post->id,$post->slug])}}'>{{ $post->title }}</a>
                            </strong>
                            <br/>
                            <a href="{{route('blog.category',$post->category->slug)}}" class="text-sm text-gray-700">
                                {{__('blog.category.'.$post->category->lowername)}}</a><i class="text-sm"> - {{ $post->published_at->translatedFormat('jS M Y') }} ({{$post->published_at->diffForHumans()}})</i>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-2 text-gray-700">{{ __('blog.search.no-result') }}</p>
            @endif
        @endif
    @endif
</div>
