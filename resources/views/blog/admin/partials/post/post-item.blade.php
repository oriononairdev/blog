<li class="flex items-center px-3 @if($post->status==='Published')hover:bg-green-100 @else hover:bg-orange-100 @endif border-b border-gray-200">
    @switch($post->status)
        @case('Published')
        <div class="pr-2 text-green-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-eye"><title>{{ __('Published') }}</title>
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        </div>
        @break
        @case('Draft')
        <div class="pr-2 text-orange-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <title>{{ __('Draft') }}</title>
                <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                <path d="M2 2l7.586 7.586"></path>
                <circle cx="11" cy="11" r="2"></circle>
            </svg>
        </div>
        @break
        @case('Archived')
        <div class="pr-2 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <title>{{ __('Archived') }}</title>
                <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                <path d="M2 2l7.586 7.586"></path>
                <circle cx="11" cy="11" r="2"></circle>
            </svg>
        </div>
        @break
    @endswitch
<a class="flex-grow py-3 block truncate text-sm sm:text-base"
   href="{{ route('blog.admin.posts.edit', $post) }}">{{ $post->title }}</a>
<div class="text-xs text-gray-500 font-medium pr-4 whitespace-no-wrap w-40 text-right"
     title="{{ $post->created_at }}">
    {{ $post->published_at->format('M jS Y') }}
</div>

<div class="text-red-500">
    @include('blog.admin.partials.post.delete-post', compact('post'))
</div>
</li>
