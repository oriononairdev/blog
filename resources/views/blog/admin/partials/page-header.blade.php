<div class="flex justify-between items-center bg-gray-100 px-4 mb-4 sm:px-6">
    <div class="flex items-center">
        @switch($svg ?? '')
            @case('Post List')
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1" stroke-linecap="round"
                 stroke-linejoin="round"
                 class="text-4xl sm:text-5xl text-indigo-300">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path
                    d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            @break
            @case('New Post')
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                 class="text-4xl sm:text-5xl text-indigo-300">
                <path
                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path
                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            @break
            @case('Edit Post')
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                 class="text-4xl sm:text-5xl text-indigo-300">
                <path
                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            @break
            @default
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1" stroke-linecap="round"
                 stroke-linejoin="round"
                 class="text-4xl sm:text-5xl text-indigo-300">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path
                    d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            @break
        @endswitch
        <div class="my-2 sm:my-4 ml-2 sm:ml-4">
            <h1 class="text-lg sm:text-2xl text-gray-700">{{ __($title) }}</h1>
            <p class="text-xs sm:text-sm text-gray-500">{{ __($description) }}</p>
        </div>
    </div>
    @switch($button ?? '')
        @case('New Post')
        <a href="{{ route('blog.admin.posts.create') }}"
           class="ml-2 btn-new flex items-center px-3 sm:px-4 hover:bg-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" class="sm:mr-2">
                <path
                    d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path
                    d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            <span class="sr-only sm:not-sr-only">New Post</span>
        </a>
        @break
        @case('View Post')
        <a target="_blank" href="{{$post->url}}"
           class="ml-2 btn-new flex items-center px-3 sm:px-4 hover:bg-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
            </svg>
            <span class="sr-only sm:not-sr-only">VIEW POST</span>
        </a>
        @break
        @case('Preview Post')
        <a target="_blank" href="{{$post->previewurl}}"
           class="ml-2 btn-new flex items-center px-3 sm:px-4 hover:bg-green-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
            </svg>
            <span class="sr-only sm:not-sr-only">PREVIEW</span>
        </a>
        @break
        @case('None')
        @break
        @default
    @endswitch
</div>
