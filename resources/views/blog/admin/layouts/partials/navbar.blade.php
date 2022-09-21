<nav class="ml-5 lg:ml-6 flex items-end lg:items-center lg:pr-2">
    <a href="{{ route('blog.home') }}" target="_blank" class="text-gray-600 p-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round"
             width="1em" height="1em"
             stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path
                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
        <span class="sr-only">{{ __('Site') }}</span>
    </a>
    <!--<a href="{{ route('blog.orion') }}" class="text-gray-600 p-2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round"
             width="1em" height="1em"
             stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <span class="sr-only">{{ __('Account') }}</span>
    </a>-->
    <div class="leading-none p-2">
        <button
            type="submit"
            form="logout-form"
            class="bg-transparent text-orange-500 hover:text-orange-700 p-0 normal-case text-xl text-base align-text-bottom"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 width="1em" height="1em"
                 stroke-linejoin="round">
                <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                <line x1="12" y1="2" x2="12" y2="12"></line>
            </svg>
            <span class="sr-only">{{ __('Sign Out') }}</span>
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</nav>
